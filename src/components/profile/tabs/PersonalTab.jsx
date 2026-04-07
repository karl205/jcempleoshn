import { useState } from "react";
import { useMemo } from "react";

export default function PersonalTab({ form, setForm, catalogos }) {

    const [errors, setErrors] = useState({});

    const handleChange = (e) => {
        const { name, value } = e.target;

        let updated = {
            ...form,
            [name]: value,
        };

        // si cambia departamento - reset ciudad
        if (name === "departamento_id") {
            updated.ciudad_id = "";
        }

        setForm(updated);
    };

    const ciudadesFiltradas = useMemo(() => {
        if (!form.departamento_id) return [];

        return catalogos.ciudades?.filter(
            c => c.departamento_id == form.departamento_id
        ) || [];
    }, [form.departamento_id, catalogos.ciudades]);

    const handlePhotoChange = (e) => {
        const file = e.target.files[0];

        if (file) {
            setForm({
                ...form,
                foto: file,
                foto_preview: URL.createObjectURL(file),
            });
        }
    };

    // VALIDACIONES
    const validate = () => {
        let newErrors = {};

        if (!form.telefono) newErrors.telefono = "El teléfono es obligatorio";
        if (!form.sexo_id) newErrors.sexo_id = "Seleccione el sexo";
        if (!form.pais_id) newErrors.pais_id = "Seleccione el país";
        if (!form.departamento_id) newErrors.departamento_id = "Seleccione departamento";
        if (!form.ciudad_id) newErrors.ciudad_id = "Seleccione ciudad";

        if (form.telefono && !/^[0-9]{8,15}$/.test(form.telefono)) {
            newErrors.telefono = "Teléfono inválido";
        }

        if (form.aspiracion_salarial && form.aspiracion_salarial < 0) {
            newErrors.aspiracion_salarial = "Valor inválido";
        }

        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    return (
        <div className="card shadow-sm border-0">
            <div className="card-body">

                {/* FOTO */}
                <div className="d-flex align-items-center gap-3 mb-4">
                    <img
                        src={
                            form.foto_preview
                                ? form.foto_preview
                                : form.foto && form.foto.trim() !== ""
                                    ? `http://localhost:8000/storage/fotos_perfil/${form.foto}`
                                    : "http://localhost:8000/storage/fotos_perfil/avatar.jpg"
                        }
                        alt="perfil"
                        style={{
                            width: "90px",
                            height: "90px",
                            borderRadius: "50%",
                            objectFit: "cover",
                        }}
                    />

                    <div>
                        <h5 className="fw-bold">
                            {form.nombre} {form.apellido}
                        </h5>

                        <input
                            type="file"
                            hidden
                            id="fotoInput"
                            onChange={handlePhotoChange}
                        />

                        <button
                            onClick={() => document.getElementById("fotoInput").click()}
                            className="btn btn-outline-primary btn-sm"
                        >
                            Cambiar foto
                        </button>
                    </div>
                </div>

                {/* FORM */}
                <div className="row g-3">

                    {/* NOMBRE */}
                    <div className="col-md-6">
                        <label>Nombres</label>
                        <input name="nombre" value={form.nombre || ""} readOnly className="form-control" />
                    </div>

                    <div className="col-md-6">
                        <label>Apellidos</label>
                        <input name="apellido" value={form.apellido || ""} readOnly className="form-control" />
                    </div>

                    {/* PAIS */}
                    {/* <div className="col-md-6">
                        <label>País</label>
                        <select name="pais_id" value={form.pais_id || ""} onChange={handleChange} className="form-select">
                            <option value="">Seleccione</option>
                            {catalogos.paises?.map(p => (
                                <option key={p.id} value={p.id}>{p.nombre}</option>
                            ))}
                        </select>
                        {errors.pais_id && <small className="text-danger">{errors.pais_id}</small>}
                    </div> */}

                    {/* DEPARTAMENTO */}
                    <div className="col-md-6">
                        <label>Departamento</label>
                        <select name="departamento_id" value={form.departamento_id || ""} onChange={handleChange} className="form-select">
                            <option value="">Seleccione</option>
                            {catalogos.departamentos?.map(d => (
                                <option key={d.id} value={d.id}>{d.nombre}</option>
                            ))}
                        </select>
                        {errors.departamento_id && <small className="text-danger">{errors.departamento_id}</small>}
                    </div>

                    {/* CIUDAD */}
                    <div className="col-md-6">
                        <label>Ciudad</label>
                        <select
                            name="ciudad_id"
                            value={form.ciudad_id || ""}
                            onChange={handleChange}
                            className="form-select"
                            disabled={!form.departamento_id}
                        >
                            <option value="">Seleccione</option>

                            {ciudadesFiltradas.map(c => (
                                <option key={c.id} value={c.id}>
                                    {c.nombre}
                                </option>
                            ))}
                        </select>

                        {errors.ciudad_id && (
                            <small className="text-danger">{errors.ciudad_id}</small>
                        )}
                    </div>

                    {/* FECHA NACIMIENTO */}
                    <div className="col-md-6">
                        <label>Fecha de nacimiento</label>
                        <input
                            type="date"
                            name="fecha_nacimiento"
                            value={form.fecha_nacimiento || ""}
                            onChange={handleChange}
                            className="form-control"
                        />
                    </div>

                    {/* TELEFONO */}
                    <div className="col-md-6">
                        <label>Teléfono</label>
                        <input
                            type="text"
                            name="telefono"
                            value={form.telefono || ""}
                            onChange={(e) => {
                                const value = e.target.value.replace(/\D/g, "");
                                handleChange({
                                    target: {
                                        name: "telefono",
                                        value
                                    }
                                });
                            }}
                            inputMode="numeric" // 📱 teclado numérico en móvil
                            className="form-control"
                            placeholder="Ej: 98765432"
                        />
                        {errors.telefono && <small className="text-danger">{errors.telefono}</small>}
                    </div>

                    {/* SEXO */}
                    <div className="col-md-6">
                        <label>Género</label>
                        <select name="sexo_id" value={form.sexo_id || ""} onChange={handleChange} className="form-select">
                            <option value="">Seleccione</option>
                            {catalogos.sexos?.map(s => (
                                <option key={s.id} value={s.id}>{s.nombre}</option>
                            ))}
                        </select>
                        {errors.sexo_id && <small className="text-danger">{errors.sexo_id}</small>}
                    </div>

                    {/* ASPIRACION */}
                    <div className="col-md-6">
                        <label>Aspiración salarial</label>
                        <input
                            type="text"
                            name="aspiracion_salarial"
                            value={form.aspiracion_salarial || ""}
                            onChange={(e) => {
                                const value = e.target.value.replace(/\D/g, "");

                                handleChange({
                                    target: {
                                        name: "aspiracion_salarial",
                                        value,
                                    },
                                });
                            }}
                            inputMode="numeric"
                            className="form-control"
                            placeholder="Ej: 25000"
                        />

                        {errors.aspiracion_salarial && (
                            <small className="text-danger">
                                {errors.aspiracion_salarial}
                            </small>
                        )}
                    </div>

                    {/* DISPONIBILIDAD */}
                    <div className="col-md-6">
                        <label>Disponibilidad vehicular</label>
                        <select
                            name="disponibilidad_vehicular_id"
                            value={form.disponibilidad_vehicular_id || ""}
                            onChange={handleChange}
                            className="form-select"
                        >
                            <option value="">Seleccione</option>
                            {catalogos.vehiculos?.map(v => (
                                <option key={v.id} value={v.id}>{v.nombre}</option>
                            ))}
                        </select>
                    </div>

                    {/* ACERCA */}
                    <div className="col-12">
                        <label>Acerca de mí</label>
                        <textarea
                            name="acerca_de_mi"
                            value={form.acerca_de_mi || ""}
                            onChange={handleChange}
                            className="form-control"
                            rows="3"
                        />
                    </div>

                </div>

            </div>
        </div>
    );
}