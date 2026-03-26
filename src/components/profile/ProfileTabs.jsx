import { useState } from "react";
import PersonalTab from "./tabs/PersonalTab";
import AcademicTab from "./tabs/AcademicTab";
import LanguagesTab from "./tabs/LanguagesTab";
import ExperienceTab from "./tabs/ExperienceTab";

export default function ProfileTabs({ form, setForm, catalogos }) {
    const [active, setActive] = useState("personal");

    return (
        <div>

            {/* NAV TABS */}
            <div className="border-bottom px-3 pt-3">
                <ul className="nav nav-pills gap-2">

                    <li className="nav-item">
                        <button
                            className={`nav-link ${active === "personal" ? "active" : ""}`}
                            onClick={() => setActive("personal")}
                        >
                            Información
                        </button>
                    </li>

                    <li className="nav-item">
                        <button
                            className={`nav-link ${active === "academic" ? "active" : ""}`}
                            onClick={() => setActive("academic")}
                        >
                            Formación
                        </button>
                    </li>

                    <li className="nav-item">
                        <button
                            className={`nav-link ${active === "languages" ? "active" : ""}`}
                            onClick={() => setActive("languages")}
                        >
                            Idiomas
                        </button>
                    </li>

                    <li className="nav-item">
                        <button
                            className={`nav-link ${active === "experience" ? "active" : ""}`}
                            onClick={() => setActive("experience")}
                        >
                            Experiencia
                        </button>
                    </li>

                </ul>
            </div>

            {/* CONTENT */}
            <div className="p-3">

                {active === "personal" && (
                    <PersonalTab
                        form={form}
                        setForm={setForm}
                        catalogos={catalogos}
                    />
                )}

                {active === "academic" && (
                    <AcademicTab
                        data={form.educations || []}
                        catalogos={catalogos}
                        onChange={(val) =>
                            setForm({ ...form, educations: val })
                        }
                    />
                )}

                {active === "languages" && (
                    <LanguagesTab
                        data={form.languages || []}
                        catalogos={catalogos}
                        onChange={(val) =>
                            setForm({ ...form, languages: val })
                        }
                    />
                )}

                {active === "experience" && (
                    <ExperienceTab
                        data={form.experiences || []}
                        onChange={(val) =>
                            setForm({ ...form, experiences: val })
                        }
                    />
                )}

            </div>

        </div>
    );
}