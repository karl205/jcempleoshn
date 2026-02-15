import { useState } from "react";
import { motion } from "framer-motion";

export default function CommentForm() {
  const [comment, setComment] = useState("");

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

          <div className="position-relative mb-4">
            <textarea
              className="form-control comment-textarea-modern"
              rows="4"
              maxLength="250"
              value={comment}
              onChange={(e) => setComment(e.target.value)}
              placeholder="Escribe tu experiencia con JC Empleos..."
            />
            <small className="char-counter-modern">
              {comment.length}/250
            </small>
          </div>

          <div className="text-center">
            <button
              className="btn-comment-elegant"
              disabled={!comment.trim()}
            >
              💬 Enviar comentario
            </button>
          </div>

        </motion.div>

      </div>
    </section>
  );
}
