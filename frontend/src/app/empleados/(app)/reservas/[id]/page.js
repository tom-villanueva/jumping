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

export default function ReservaDetailPage({ params }) {
  const [open, setOpen] = useState(false)

  const { reserva, isLoading, isError } = useReservaById({
    id: params.id,
    params: {
      include: 'estado,user,equipos',
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
        <p>
          {`Reserva Nro. `}
          <span className="font-bold">{reserva.id}</span>
        </p>
        <p>
          {`A nombre de `}
          <span className="font-bold">{`${reserva.apellido}, ${reserva.nombre}.`}</span>
        </p>
        <p>
          {`Desde el `}
          <span className="font-bold">
            {convertToUTC(reserva.fecha_desde).toLocaleDateString()}
          </span>
          {` hasta el `}
          <span className="font-bold">
            {convertToUTC(reserva.fecha_hasta).toLocaleDateString()}
          </span>
        </p>
        <p>
          {`Estado `}
          <span className="font-bold">{reserva?.estado?.descripcion}</span>
        </p>
      </div>

      <Separator className="mt-8 w-full" />

      <ReservaEquipoList reservaId={params.id} />

      <Collapsible open={open} onOpenChange={setOpen} className="space-y-2">
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
          <ReservaFormContent
            onFormSubmit={() => {}}
            reserva={reserva}
            estados={estados}
            editing
          />
        </CollapsibleContent>
      </Collapsible>
    </div>
  )
}