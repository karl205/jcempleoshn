export default function PersonalTab({ form, setForm, catalogos }) {

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

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

    return (
        <div className="card shadow-sm border-0">
            <div className="card-body">

                {/* FOTO */}
                <div className="d-flex align-items-center gap-3 mb-4">
                    <img
                        src={
                            form.foto_preview
                                ? form.foto_preview
                                : form.foto
                                    ? `http://localhost:8000/storage/fotos_perfil/${form.foto}`
                                    : "/avatar.png"
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

                    <div className="col-md-6">
                        <label>Nombres</label>
                        <input name="nombre" value={form.nombre || ""} readOnly onChange={handleChange} className="form-control" />
                    </div>

                    <div className="col-md-6">
                        <label>Apellidos</label>
                        <input name="apellido" value={form.apellido || ""} readOnly onChange={handleChange} className="form-control" />
                    </div>

                    <div className="col-md-6">
                        <label>Sexo</label>
                        <select name="sexo_id" value={form.sexo_id || ""} onChange={handleChange} className="form-select">
                            <option value="">Seleccione</option>
                            {catalogos.sexos?.map(s => (
                                <option key={s.id} value={s.id}>{s.nombre}</option>
                            ))}
                        </select>
                    </div>

                    <div className="col-md-6">
                        <label>País</label>
                        <select name="pais_id" value={form.pais_id || ""} onChange={handleChange} className="form-select">
                            <option value="">Seleccione</option>
                            {catalogos.paises?.map(p => (
                                <option key={p.id} value={p.id}>{p.nombre}</option>
                            ))}
                        </select>
                    </div>

                    <div className="col-md-6">
                        <label>Teléfono</label>
                        <input name="telefono" value={form.telefono || ""} onChange={handleChange} className="form-control" />
                    </div>

                    <div className="col-12">
                        <label>Acerca de mí</label>
                        <textarea name="acerca_de_mi" value={form.acerca_de_mi || ""} onChange={handleChange} className="form-control" />
                    </div>

                </div>

            </div>
        </div>
    );
}