import { useState } from "react";
import { motion } from "framer-motion";
import { useAuth } from "../context/AuthContext";
import { createTestimonio } from "../api/profileService";

export default function CommentForm() {

  const { user } = useAuth();

  const [comment, setComment] = useState("");
  const [rating, setRating] = useState(0);
  const [hover, setHover] = useState(0);

  const [error, setError] = useState(null);
  const [success, setSuccess] = useState(null);
  const [sending, setSending] = useState(false);

  const handleSubmit = async () => {
    setError(null);
    setSuccess(null);

    if (!comment.trim()) {
      setError("Debe escribir un comentario");
      return;
    }

    if (!rating) {
      setError("Seleccione una calificación");
      return;
    }

    // validar login
    if (!user) {
      setError("Debe iniciar sesión para comentar");
      return;
    }

    try {
      setSending(true);

      await createTestimonio({
        comentario: comment,
        calificacion: rating
      });

      setSuccess("Gracias por tu comentario.");

      setComment("");
      setRating(0);

    } catch (err) {
      setError(err.response?.data?.message || "Error al enviar comentario");
    } finally {
      setSending(false);
    }
  };

  return (
    <section className="comment-section-white">
      <div className="container">

        <motion.div
          initial={{ opacity: 0, y: 50 }}
          whileInView={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6 }}
          viewport={{ once: true }}
          className="comment-wide-wrapper"
        >

          <div className="text-center mb-4">
            <h3 className="fw-bold mb-2">
              Déjanos tu comentario
            </h3>
            <p className="text-muted">
              Comparte tu experiencia con otros usuarios
            </p>
          </div>

          {/* ⭐ ESTRELLAS */}
          <div className="text-center mb-3">
            {[1, 2, 3, 4, 5].map((star) => (
              <span
                key={star}
                style={{
                  fontSize: "1.8rem",
                  cursor: "pointer",
                  color: star <= (hover || rating) ? "#ffc107" : "#e4e5e9",
                }}
                onClick={() => setRating(star)}
                onMouseEnter={() => setHover(star)}
                onMouseLeave={() => setHover(0)}
              >
                ★
              </span>
            ))}
          </div>

          {/* TEXTAREA */}
          <div className="position-relative mb-3">
            <textarea
              className="form-control comment-textarea-modern"
              rows="4"
              maxLength="100"
              value={comment}
              onChange={(e) => setComment(e.target.value)}
              placeholder="Escribe tu experiencia con JC Empleos..."
            />
            <small className="char-counter-modern">
              {comment.length}/100
            </small>
          </div>

          {/* MENSAJES */}
          {error && (
            <div className="alert alert-danger py-2 text-center">
              {error}
            </div>
          )}

          {success && (
            <div className="alert alert-success py-2 text-center">
              {success}
            </div>
          )}

          {/* BOTÓN */}
          <div className="text-center">
            <button
              className="btn-comment-elegant"
              disabled={!comment.trim() || sending}
              onClick={handleSubmit}
            >
              {sending ? "Enviando..." : "💬 Enviar comentario"}
            </button>
          </div>

        </motion.div>

      </div>
    </section>
  );
}