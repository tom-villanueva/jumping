'use client'

import { useEstados } from '@/services/estados'
import { useReservaById } from '@/services/reservas'
import ReservaFormContent from '../sections/ReservaFormContent'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import { useState } from 'react'
import { Edit } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { convertToUTC } from '@/lib/utils'
import ReservaEquipoList from './ReservaEquipoList'
import { Separator } from '@/components/ui/separator'
import ReservaDetailLabel from './ReservaDetailLabel'

export default function ReservaDetailPage({ params }) {
  const [open, setOpen] = useState(false)

  const { reserva, isLoading, isError, isValidating } = useReservaById({
    id: params.id,
    params: {
      include: 'user,equipos',
    },
  })
  const { estados, isLoading: isLoadingEstados } = useEstados({})

  if (isLoading) {
    return (
      <div className="container mx-auto pt-10">
        <p>Cargando Reserva...</p>
      </div>
    )
  }

  return (
    <div className="container mx-auto pt-10">
      <div className="rounded-md border px-2 py-3 text-base">
        <ReservaDetailLabel
          title="Reserva Nro."
          label={reserva.id}
          isValidating={isValidating}
        />
        <ReservaDetailLabel
          title="A nombre de"
          label={`${reserva.apellido}, ${reserva.nombre}.`}
          isValidating={isValidating}
        />
        <ReservaDetailLabel
          title="Desde el"
          label={convertToUTC(reserva.fecha_desde).toLocaleDateString()}
          isValidating={isValidating}
        />
        <ReservaDetailLabel
          title="Hasta el"
          label={convertToUTC(reserva.fecha_hasta).toLocaleDateString()}
          isValidating={isValidating}
        />
        <ReservaDetailLabel
          title="Fecha de prueba"
          label={convertToUTC(reserva.fecha_prueba).toLocaleDateString()}
          isValidating={isValidating}
        />
        <ReservaDetailLabel
          title="Estado"
          label={reserva?.estado_actual?.estado?.descripcion}
          isValidating={isValidating}
        />
        <Separator className="my-2 w-full" />
        <ReservaDetailLabel
          title="Total"
          label={new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
          }).format(reserva?.precio_total)}
          isValidating={isValidating}
        />
      </div>

      <Separator className="mt-8 w-full" />

      <ReservaEquipoList reservaId={params.id} />

      <Collapsible
        open={open}
        onOpenChange={setOpen}
        className="mt-2 space-y-2">
        <div className="flex w-[250px] items-center justify-between space-x-4 px-2">
          <h4 className="text-sm font-semibold">Datos de la reserva</h4>
          <CollapsibleTrigger asChild>
            <Button variant="ghost" size="sm" className="w-9 p-0">
              <Edit className="h-4 w-4" />
              <span className="sr-only">Toggle</span>
            </Button>
          </CollapsibleTrigger>
        </div>
        <CollapsibleContent>
          {!isValidating ? (
            <ReservaFormContent
              onFormSubmit={() => {}}
              reserva={reserva}
              estados={estados}
              apiKey={`/api/reservas/${params.id}`}
              editing
            />
          ) : (
            <div className="flex w-full items-center justify-center">
              <p className="">Cargando...</p>
            </div>
          )}
        </CollapsibleContent>
      </Collapsible>
    </div>
  )
}
