import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import HelpButton from "../components/HelpButton";

export default function PublicLayout({ children }) {
  return (
    <div className="d-flex flex-column min-vh-100">

      <Navbar />

      <main className="flex-grow-1">
        {children} {/* IMPORTANTE */}
      </main>

      <Footer />
      <HelpButton seccion="publico" /> 
    </div>
  );
}
