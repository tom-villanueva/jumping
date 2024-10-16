'use client'

import { useReservasEstadisticas } from '@/services/reservas'
import InfoChart from './InfoChart'
import InfoCard from './InfoCard'

const year = new Date().getFullYear()

function calcularPorcentaje(value1, value2) {
  return ((value1 - value2) / value2) * 100
}

export default function EstadisticasContainer() {
  const { estadisticas, isLoading, isError } = useReservasEstadisticas()

  if (isLoading) {
    return <div>Cargando</div>
  }

  return (
    <>
      <div className="col-span-2 mb-5 grid w-full grid-cols-2 gap-2 sm:my-0 sm:gap-5">
        <InfoCard
          title={`Cant. Reservas ${year}`}
          number={estadisticas.yearly_estadisticas[year][0].cantidad_reservas}
          percentage={calcularPorcentaje(
            estadisticas.yearly_estadisticas[year][0].cantidad_reservas,
            estadisticas.yearly_estadisticas[year - 1][0].cantidad_reservas,
          )}
          footer="Con respecto al período anterior"
        />

        <InfoCard
          title={`Total $ ${year}`}
          number={new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
          }).format(estadisticas.yearly_estadisticas[year][0].ingreso_total)}
          percentage={calcularPorcentaje(
            estadisticas.yearly_estadisticas[year][0].ingreso_total,
            estadisticas.yearly_estadisticas[year - 1][0].ingreso_total,
          )}
          footer="Con respecto al período anterior"
        />
        <InfoCard
          title={`Cant. Reservas ${year - 1}`}
          number={
            estadisticas.yearly_estadisticas[year - 1][0].cantidad_reservas
          }
          percentage={calcularPorcentaje(
            estadisticas.yearly_estadisticas[year - 1][0].cantidad_reservas,
            estadisticas.yearly_estadisticas[year - 2][0].cantidad_reservas,
          )}
          footer="Con respecto al período anterior"
        />
        <InfoCard
          title={`Total $ ${year - 1}`}
          number={new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
          }).format(
            estadisticas.yearly_estadisticas[year - 1][0].ingreso_total,
          )}
          percentage={calcularPorcentaje(
            estadisticas.yearly_estadisticas[year - 1][0].ingreso_total,
            estadisticas.yearly_estadisticas[year - 2][0].ingreso_total,
          )}
          footer="Con respecto al período anterior"
        />
      </div>
      <div className="col-span-3 flex flex-col gap-8 rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Reservas</p>
        <InfoChart data={estadisticas?.monthly_estadisticas} />
      </div>
    </>
  )
}
