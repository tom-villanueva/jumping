'use client'

import { useReservasEstadisticas } from '@/services/reservas'
import InfoChart from './InfoChart'
import InfoCard from './InfoCard'

const year = new Date().getFullYear()

function calcularPorcentaje(value1, value2) {
  if (!value2 || value2 === 0) return 0
  return ((value1 - value2) / value2) * 100
}

export default function EstadisticasContainer() {
  const { estadisticas, isLoading, isError } = useReservasEstadisticas()

  if (isLoading) {
    return <div>Cargando</div>
  }

  if (
    estadisticas.yearly_estadisticas.length === 0 ||
    estadisticas.monthly_estadisticas.length === 0
  ) {
    return (
      <div className="col-span-2 mb-5 grid w-full grid-cols-2 gap-2 sm:my-0 sm:gap-5">
        No hay datos.
      </div>
    )
  }

  // Get data for current year and previous years if they exist
  const currentYearData = estadisticas.yearly_estadisticas[year]?.[0] || {}
  const lastYearData = estadisticas.yearly_estadisticas[year - 1]?.[0] || {}
  const twoYearsAgoData = estadisticas.yearly_estadisticas[year - 2]?.[0] || {}

  return (
    <>
      <div className="col-span-2 mb-5 grid w-full grid-cols-2 gap-2 sm:my-0 sm:gap-5">
        {/* Current Year */}
        <InfoCard
          title={`Cant. Reservas ${year}`}
          number={currentYearData.cantidad_reservas || 0}
          percentage={calcularPorcentaje(
            currentYearData.cantidad_reservas || 0,
            lastYearData.cantidad_reservas || 0,
          )}
          footer="Con respecto al período anterior"
        />

        <InfoCard
          title={`Total $ ${year}`}
          number={new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
          }).format(currentYearData.ingreso_total || 0)}
          percentage={calcularPorcentaje(
            currentYearData.ingreso_total || 0,
            lastYearData.ingreso_total || 0,
          )}
          footer="Con respecto al período anterior"
        />

        {/* Last Year */}
        {lastYearData.cantidad_reservas !== undefined && (
          <InfoCard
            title={`Cant. Reservas ${year - 1}`}
            number={lastYearData.cantidad_reservas}
            percentage={calcularPorcentaje(
              lastYearData.cantidad_reservas || 0,
              twoYearsAgoData.cantidad_reservas || 0,
            )}
            footer="Con respecto al período anterior"
          />
        )}

        {lastYearData.ingreso_total !== undefined && (
          <InfoCard
            title={`Total $ ${year - 1}`}
            number={new Intl.NumberFormat('es-AR', {
              style: 'currency',
              currency: 'ARS',
            }).format(lastYearData.ingreso_total || 0)}
            percentage={calcularPorcentaje(
              lastYearData.ingreso_total || 0,
              twoYearsAgoData.ingreso_total || 0,
            )}
            footer="Con respecto al período anterior"
          />
        )}
      </div>

      <div className="col-span-3 flex flex-col gap-8 rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Ingresos por año</p>
        <InfoChart data={estadisticas?.monthly_estadisticas} />
      </div>
    </>
  )
}
