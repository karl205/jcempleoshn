export default function PlazaVerModal({ show, onClose, plaza }) {
    if (!show || !plaza) return null;

    const campo = (label, valor) => (
        <div className="col-md-4">
            <label className="fw-semibold small text-muted">{label}</label>
            <p className="form-control bg-light mb-0">{valor || "—"}</p>
        </div>
    );

    return (
        <div className="modal-overlay">
            <div className="modal-card modal-xl">

                <div className="modal-header">
                    <h5>Ver Plaza</h5>
                    <button className="modal-close" onClick={onClose}>✕</button>
                </div>

                <div className="modal-body">

                    {/* INFORMACIÓN GENERAL */}
                    <h6 className="section-title">Información General</h6>
                    <div className="row g-3">

                        <div className="col-md-12">
                            <label className="fw-semibold small text-muted">Título</label>
                            <p className="form-control bg-light mb-0">{plaza.titulo || "—"}</p>
                        </div>

                        <div className="col-md-12">
                            <label className="fw-semibold small text-muted">Descripción</label>
                            <p className="form-control bg-light mb-0" style={{ whiteSpace: "pre-wrap" }}>
                                {plaza.descripcion || "—"}
                            </p>
                        </div>

                        <div className="col-md-6">
                            <label className="fw-semibold small text-muted">Requisitos</label>
                            <p className="form-control bg-light mb-0" style={{ whiteSpace: "pre-wrap" }}>
                                {plaza.requisitos || "—"}
                            </p>
                        </div>

                        <div className="col-md-6">
                            <label className="fw-semibold small text-muted">Beneficios</label>
                            <p className="form-control bg-light mb-0" style={{ whiteSpace: "pre-wrap" }}>
                                {plaza.beneficios || "—"}
                            </p>
                        </div>

                    </div>

                    {/* INFORMACIÓN LABORAL */}
                    <h6 className="section-title mt-4">Información Laboral</h6>
                    <div className="row g-3">
                        {campo("Categoría laboral", plaza.categoria)}
                        {campo("Cargo", plaza.cargo)}
                        {campo("Actividad laboral", plaza.actividad)}
                        {campo("Departamento", plaza.departamento)}
                        {campo("Ciudad", plaza.ciudad)}
                        {campo("Tipo de contratación", plaza.tipo_contratacion)}
                    </div>

                    {/* REQUISITOS DEL CANDIDATO */}
                    <h6 className="section-title mt-4">Requisitos del candidato</h6>
                    <div className="row g-3">
                        {campo("Nivel educativo", plaza.nivel_educativo)}
                        {campo("Sexo", plaza.sexo)}
                        {campo("Experiencia mínima (años)", plaza.experiencia_minima)}
                        {campo("Edad mínima", plaza.edad_minima)}
                        {campo("Edad máxima", plaza.edad_maxima)}
                    </div>

                    {/* INFORMACIÓN SALARIAL */}
                    <h6 className="section-title mt-4">Información salarial</h6>
                    <div className="row g-3">
                        {campo("Salario mínimo", plaza.salario_min)}
                        {campo("Salario máximo", plaza.salario_max)}
                    </div>

                </div>

                <div className="modal-footer mt-4">
                    <button className="btn btn-light" onClick={onClose}>Cerrar</button>
                </div>

            </div>
        </div>
    );
}