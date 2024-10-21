export default function ReservaMarcarComoPagadaDetallePrecio({
  precioTotal,
  metodoSeleccionado,
  tipoSeleccionado,
  metodos,
  tipoPersonas,
}) {
  // Find selected method discount
  const metodoDescuento = metodos.find(t => t.id === Number(metodoSeleccionado))
    ?.descuento?.valor

  // Find selected person type discount
  const tipoPersonaDescuento = tipoPersonas.find(
    t => t.id === Number(tipoSeleccionado),
  )?.descuento?.valor

  return (
    <div className="col-span-12">
      <table className="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr>
            <th className="border-b border-gray-300 px-4 py-2 text-left">
              Descripción
            </th>
            <th className="border-b border-gray-300 px-4 py-2 text-right">
              Monto
            </th>
          </tr>
        </thead>
        <tbody>
          {/* Total Price Row */}
          <tr>
            <td className="border-b border-gray-300 px-4 py-2">Precio Total</td>
            <td className="border-b border-gray-300 px-4 py-2 text-right">
              {new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(precioTotal)}
            </td>
          </tr>

          {/* Metodo Descuento Row */}
          <tr>
            <td className="border-b border-gray-300 px-4 py-2">
              Descuento Método
            </td>
            <td className="border-b border-gray-300 px-4 py-2 text-right">
              {new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(
                metodoDescuento ? (metodoDescuento / 100) * precioTotal : 0,
              )}
            </td>
          </tr>

          {/* Tipo Persona Descuento Row */}
          <tr>
            <td className="border-b border-gray-300 px-4 py-2">
              Descuento Tier
            </td>
            <td className="border-b border-gray-300 px-4 py-2 text-right">
              {new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(
                tipoPersonaDescuento
                  ? (tipoPersonaDescuento / 100) * precioTotal
                  : 0,
              )}
            </td>
          </tr>

          {/* Final Price Row */}
          <tr>
            <td className="border-b border-gray-300 px-4 py-2 font-bold">
              Precio Final
            </td>
            <td className="border-b border-gray-300 px-4 py-2 text-right font-bold">
              {new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(
                precioTotal -
                  (tipoPersonaDescuento
                    ? (tipoPersonaDescuento / 100) * precioTotal
                    : 0) -
                  (metodoDescuento ? (metodoDescuento / 100) * precioTotal : 0),
              )}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  )
}
