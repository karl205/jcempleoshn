import { useEffect, useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay } from "swiper/modules";

import "swiper/css";
import { getTestimonios } from "../api/profileService";

export default function Testimonials() {

  const [comentarios, setComentarios] = useState([]);

  useEffect(() => {
    cargar();
  }, []);

  const cargar = async () => {
    try {
      const res = await getTestimonios();
      setComentarios(res.data);
    } catch (error) {
      console.error("Error cargando testimonios", error);
    }
  };

  const renderStars = (num) => {
    return "★".repeat(num) + "☆".repeat(5 - num);
  };

  return (
    <section className="testimonials-section">
      <div className="container">

        <h3 className="text-center fw-bold mb-4">
          Comentarios de nuestros usuarios
        </h3>

        <Swiper
          modules={[Autoplay]}
          spaceBetween={24}
          slidesPerView={Math.min(4, comentarios.length)}
          breakpoints={{
            576: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 4 },
          }}
          loop={comentarios.length > 4}
          autoplay={{
            delay: 2500,
            disableOnInteraction: false,
          }}
        >

          {comentarios.map((c, index) => (
            <SwiperSlide key={index}>
              <div className="comment-card p-4 shadow-sm rounded bg-white">

                <p className="mb-3">“{c.comentario}”</p>

                {/* Estrellas */}
                <div className="mb-2 text-warning">
                  {renderStars(c.calificacion)}
                </div>

                <div className="d-flex align-items-center gap-3">
                  <div className="avatar">👤</div>

                  <div>
                    <strong>{c.nombre}</strong>
                  </div>
                </div>

              </div>
            </SwiperSlide>
          ))}

        </Swiper>

      </div>
    </section>
  );
}