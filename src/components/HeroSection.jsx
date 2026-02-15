import logo from "../assets/logo.png";

export default function HeroSection() {
  return (
    <section className="hero-wrapper position-relative">

     

       <img
        src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d"
        className="w-100 hero-image"
        alt="Banner"
      />

      <div className="hero-overlay"></div>

      <div className="position-absolute top-50 start-50 translate-middle w-100 px-3">
        <div className="hero-panel mx-auto text-center">

          {/* LOGO */}
          <img
            src={logo}
            alt="JC Empleos"
            className="hero-logo mb-3"
          />

          <h2 className="fw-bold mb-2">
            Encuentra tu próxima oportunidad laboral
          </h2>

          <p className="text-muted mb-4">
            Plazas actualizadas diariamente en Honduras
          </p>

          <div className="row g-3">
            <div className="col-md-4">
              <select className="form-select rounded-pill">
                <option>Área</option>
              </select>
            </div>

            <div className="col-md-4">
              <select className="form-select rounded-pill">
                <option>Cargo</option>
              </select>
            </div>

            <div className="col-md-4">
              <select className="form-select rounded-pill">
                <option>Departamento</option>
              </select>
            </div>

            <div className="col-12 d-grid mt-3">
              <button className="btn btn-primary btn-lg rounded-pill">
                Buscar empleos
              </button>
            </div>
          </div>

        </div>
      </div>

    </section>
  );
}
