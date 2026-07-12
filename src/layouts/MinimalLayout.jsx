export default function MinimalLayout({ children, onBrandClick }) {
  return (
    <div className="d-flex flex-column min-vh-100">

      <nav className="navbar navbar-modern">
        <div className="container">
          {onBrandClick ? (
            <button
              type="button"
              className="navbar-brand d-flex align-items-center gap-2 btn btn-link p-0 text-decoration-none"
              onClick={onBrandClick}
            >
              <span className="brand-text">JC Empleos</span>
            </button>
          ) : (
            <span className="navbar-brand d-flex align-items-center gap-2">
              <span className="brand-text">JC Empleos</span>
            </span>
          )}
        </div>
      </nav>

      <main className="flex-grow-1 d-flex align-items-center justify-content-center">
        {children}
      </main>

    </div>
  );
}