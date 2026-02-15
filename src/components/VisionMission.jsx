import { motion } from "framer-motion";
import { FaEye, FaFlag, FaBullseye } from "react-icons/fa";

export default function VisionMission() {
  const items = [
    {
      icon: <FaEye />,
      title: "Visión",
      text: "Ser la plataforma líder que conecta talento con oportunidades laborales.",
    },
    {
      icon: <FaFlag />,
      title: "Misión",
      text: "Facilitar el acceso a empleo con procesos simples y modernos.",
    },
    {
      icon: <FaBullseye />,
      title: "Objetivo",
      text: "Optimizar la búsqueda y postulación laboral.",
    },
  ];

  return (
    <section className="vm-section py-5">
      <div className="container">

        <div className="text-center mb-5">
          <h3 className="fw-bold">Visión · Misión · Objetivo</h3>
          <p className="text-muted">
            El propósito que guía nuestro trabajo
          </p>
        </div>

        <div className="row g-4">
          {items.map((v, index) => (
            <div className="col-md-4" key={index}>

              <motion.div
                initial={{ opacity: 0, y: 40 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.15 }}
                viewport={{ once: true }}
                whileHover={{ y: -8 }}
                className="vm-card-modern text-center h-100"
              >

                <div className="vm-icon-modern mb-4">
                  {v.icon}
                </div>

                <h5 className="fw-bold mb-3">{v.title}</h5>

                <p className="text-muted mb-0">
                  {v.text}
                </p>

              </motion.div>

            </div>
          ))}
        </div>

      </div>
    </section>
  );
}
