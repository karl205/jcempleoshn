import { useState, useEffect, useRef } from "react";
import {
  FaCommentDots,
  FaTimes,
  FaFilePdf,
  FaEye,
  FaDownload,
} from "react-icons/fa";
import {
  getAyudaPublica,
  getAyudaPublicaVerUrl,
  getAyudaPublicaDescargarUrl,
} from "../api/ayudaService";
import {
  getAyudaAdminConsulta,
  verAyudaAdmin,
  descargarAyudaAdmin,
} from "../api/adminAyudaService";

// seccion: "publico" | "admin"
export default function HelpButton({ seccion = "publico" }) {
  const [open, setOpen] = useState(false);
  const [items, setItems] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [procesando, setProcesando] = useState(null);

  const panelRef = useRef(null);

  useEffect(() => {
    if (!open) return;

    setLoading(true);
    setError(null);

    const request =
      seccion === "admin" ? getAyudaAdminConsulta() : getAyudaPublica();

    request
      .then((res) => setItems(res.data?.data ?? []))
      .catch(() => setError("No se pudo cargar la ayuda"))
      .finally(() => setLoading(false));
  }, [open, seccion]);

  // Cierra al hacer clic afuera. Usa "mousedown" (no "click"), así que
  // seleccionar texto arrastrando el mouse dentro del panel nunca lo cierra.
  useEffect(() => {
    if (!open) return;

    const handleMouseDown = (e) => {
      if (panelRef.current && !panelRef.current.contains(e.target)) {
        setOpen(false);
      }
    };

    document.addEventListener("mousedown", handleMouseDown);
    return () => document.removeEventListener("mousedown", handleMouseDown);
  }, [open]);

  const abrirBlob = (blob, nombre, forzarDescarga) => {
    const blobUrl = URL.createObjectURL(new Blob([blob], { type: "application/pdf" }));

    if (forzarDescarga) {
      const link = document.createElement("a");
      link.href = blobUrl;
      link.download = `${nombre}.pdf`;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    } else {
      window.open(blobUrl, "_blank");
    }

    setTimeout(() => URL.revokeObjectURL(blobUrl), 10000);
  };

  const handleVer = async (item) => {
    if (seccion === "publico") {
      window.open(getAyudaPublicaVerUrl(item.id), "_blank");
      return;
    }

    try {
      setProcesando(item.id);
      const res = await verAyudaAdmin(item.id);
      abrirBlob(res.data, item.titulo, false);
    } catch {
      setError("No se pudo abrir el documento");
    } finally {
      setProcesando(null);
    }
  };

  const handleDescargar = async (item) => {
    if (seccion === "publico") {
      const link = document.createElement("a");
      link.href = getAyudaPublicaDescargarUrl(item.id);
      link.target = "_blank";
      link.rel = "noopener noreferrer";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      return;
    }

    try {
      setProcesando(item.id);
      const res = await descargarAyudaAdmin(item.id);
      abrirBlob(res.data, item.titulo, true);
    } catch {
      setError("No se pudo descargar el documento");
    } finally {
      setProcesando(null);
    }
  };

  return (
    <div className="help-widget" ref={panelRef}>

      {open && (
        <div className="help-panel">
          <div className="help-panel-header">
            <div className="help-panel-heading">
              <FaCommentDots className="help-panel-heading-icon" />
              <div>
                <h2>Centro de ayuda</h2>
                <p>Guías y manuales en PDF</p>
              </div>
            </div>
            <button
              className="help-close-btn"
              onClick={() => setOpen(false)}
              aria-label="Cerrar"
            >
              <FaTimes />
            </button>
          </div>

          <div className="help-panel-body">
            {loading && (
              <div className="help-status">
                <span className="help-spinner" />
                Cargando documentos...
              </div>
            )}

            {error && <p className="help-status help-error">{error}</p>}

            {!loading && !error && items.length === 0 && (
              <div className="help-empty">
                <FaFilePdf className="help-empty-icon" />
                <p>Todavía no hay documentos de ayuda disponibles.</p>
              </div>
            )}

            <ul className="help-list">
              {items.map((item) => (
                <li key={item.id} className="help-item">
                  <div className="help-item-icon">
                    <FaFilePdf />
                  </div>

                  <div className="help-item-info">
                    <span className="help-item-title">{item.titulo}</span>
                    {item.descripcion && (
                      <span className="help-item-desc">{item.descripcion}</span>
                    )}
                  </div>

                  <div className="help-item-actions">
                    <button
                      className="help-icon-btn"
                      title="Ver"
                      onClick={() => handleVer(item)}
                      disabled={procesando === item.id}
                    >
                      <FaEye />
                    </button>
                    <button
                      className="help-icon-btn"
                      title="Descargar"
                      onClick={() => handleDescargar(item)}
                      disabled={procesando === item.id}
                    >
                      <FaDownload />
                    </button>
                  </div>
                </li>
              ))}
            </ul>
          </div>
        </div>
      )}

      <button
        className={`help-fab ${open ? "help-fab-open" : ""}`}
        onClick={() => setOpen((v) => !v)}
        aria-label="Ayuda"
      >
        {open ? <FaTimes /> : <FaCommentDots />}
      </button>

    </div>
  );
}