import { useState, useMemo } from "react";

export default function AdminDataTable({
    data = [],
    columns = [],
    actions = [],
    loading = false,
}) {

    const [search, setSearch] = useState("");
    const [page, setPage] = useState(1);

    const pageSize = 8;

    // FILTRO
    const filtered = useMemo(() => {
        return data.filter(item =>
            Object.values(item)
                .join(" ")
                .toLowerCase()
                .includes(search.toLowerCase())
        );
    }, [data, search]);

    // PAGINACIÓN
    const totalPages = Math.ceil(filtered.length / pageSize);

    const paginated = useMemo(() => {
        const start = (page - 1) * pageSize;
        return filtered.slice(start, start + pageSize);
    }, [filtered, page]);

    return (
        <div className="admin-card">

            {/* BUSCADOR */}
            <div className="d-flex justify-content-between mb-3">

                <input
                    className="form-control w-25"
                    placeholder="Buscar..."
                    value={search}
                    onChange={(e) => {
                        setSearch(e.target.value);
                        setPage(1);
                    }}
                />

            </div>

            {loading ? (
                <p>Cargando...</p>
            ) : (

                <>
                    <table className="table table-hover align-middle">

                        <thead>
                            <tr>
                                {columns.map((col, i) => (
                                    <th key={i}>{col.label}</th>
                                ))}
                                {actions.length > 0 && <th className="text-end">Acciones</th>}
                            </tr>
                        </thead>

                        <tbody>

                            {paginated.map((row, i) => (

                                <tr key={i}>

                                    {columns.map((col, j) => (
                                        <td key={j}>
                                            {col.render
                                                ? col.render(row)
                                                : row[col.key]}
                                        </td>
                                    ))}

                                    {actions.length > 0 && (
                                        <td className="text-end">

                                            {actions.map((action, k) => (
                                                <button
                                                    key={k}
                                                    className={`btn btn-sm me-2 ${action.class}`}
                                                    onClick={() => action.onClick(row)}
                                                >
                                                    {action.icon}
                                                </button>
                                            ))}

                                        </td>
                                    )}

                                </tr>

                            ))}

                        </tbody>

                    </table>

                    {/* PAGINACIÓN */}
                    <div className="d-flex justify-content-end gap-2 mt-3">

                        <button
                            className="btn btn-sm btn-light"
                            disabled={page === 1}
                            onClick={() => setPage(p => p - 1)}
                        >
                            ◀
                        </button>

                        <span className="align-self-center">
                            {page} / {totalPages || 1}
                        </span>

                        <button
                            className="btn btn-sm btn-light"
                            disabled={page === totalPages}
                            onClick={() => setPage(p => p + 1)}
                        >
                            ▶
                        </button>

                    </div>
                </>
            )}

        </div>
    );
}