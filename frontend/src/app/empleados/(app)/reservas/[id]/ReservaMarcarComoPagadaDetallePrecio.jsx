import { useReservaLineasFactura } from '@/services/reservas'

export default function ReservaMarcarComoPagadaDetallePrecio({
  reservaId,
  metodoSeleccionado,
}) {
  const { precios, isLoading, isError } = useReservaLineasFactura({
    id: reservaId,
    params: { metodo_pago_id: metodoSeleccionado },
  })

  if (isLoading) {
    return <div>Cargando desglose de precios...</div>
  }

  if (isError) {
    return <div>Error al cargar los precios.</div>
  }

  const totalPrice = precios?.total_price || 0
  const priceAfterDiscounts = precios?.price_after_discounts || 0
  const invoiceLines = precios?.invoice || []

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
          {invoiceLines.map((line, index) => (
            <tr key={index}>
              <td className="border-b border-gray-300 px-4 py-2">
                {line.descripcion}
              </td>
              <td className="border-b border-gray-300 px-4 py-2 text-right">
                {new Intl.NumberFormat('es-AR', {
                  style: 'currency',
                  currency: 'ARS',
                }).format(line.precio)}
              </td>
            </tr>
          ))}

          {/* Total Price Row */}
          <tr>
            <td className="border-b border-gray-300 px-4 py-2 font-bold">
              Precio Total
            </td>
            <td className="border-b border-gray-300 px-4 py-2 text-right font-bold">
              {new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(totalPrice)}
            </td>
          </tr>

          {/* Final Price Row */}
          <tr>
            <td className="border-b border-gray-300 px-4 py-2 font-bold">
              Precio Después de Descuentos
            </td>
            <td className="border-b border-gray-300 px-4 py-2 text-right font-bold">
              {new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(priceAfterDiscounts)}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  )
}
