'use client'

import { useAsientosDisponibles } from '@/services/traslado-precios'

export default function AsientosDisponibles({ filters }) {
  const { asientos, isLoading, isError } = useAsientosDisponibles({
    fechaDesde: filters.find(f => f.id === 'fecha_desde_after')?.value ?? '',
    fechaHasta: filters.find(f => f.id === 'fecha_hasta_before')?.value ?? '',
  })

  if (isLoading) {
    return <p>Cargando asientos disponibles...</p>
  }

  if (isError) {
    return <p>Error cargando asientos disponibles...</p>
  }

  return (
    <div className="mb-8 flex flex-col gap-2 rounded-md border px-2 py-3 text-base">
      <p>Asientos máximos: {asientos?.asientos_maximos}</p>
      <p>Asientos reservados: {asientos?.asientos_reservados}</p>
      <p>Asientos disponibles: {asientos?.asientos_disponibles}</p>
    </div>
  )
}
