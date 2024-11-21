'use client'

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
import { convertToUTC, RESERVA_PAGADA_ID } from '@/lib/utils'
import ReservaEquipoList from './ReservaEquipoList'
import { Separator } from '@/components/ui/separator'
import ReservaDetailLabel from './ReservaDetailLabel'
import ReservaDetailActions from './ReservaDetailActions'
import ReservaTrasladoList from './ReservaTrasladoList'

export default function ReservaDetailPage({ params }) {
  const [open, setOpen] = useState(false)

  const { reserva, isLoading, isError, isValidating } = useReservaById({
    id: params.id,
    params: {
      include:
        'cliente,cliente.tipo_persona.descuento,equipos,pagos.metodo_pago,pagos.tipo_persona,traslados',
    },
  })

  if (isError) {
    const { status } = isError
    return (
      <div className="container mx-auto pt-10">
        {status === 404 ? (
          <p>La reserva no EXISTE.</p>
        ) : (
          <p>Ocurrió un error, intente de nuevo.</p>
        )}
      </div>
    )
  }

  if (isLoading) {
    return (
      <div className="container mx-auto pt-10">
        <p>Cargando Reserva...</p>
      </div>
    )
  }

  return (
    <div className="container mx-auto pt-10">
      <Collapsible
        open={open}
        onOpenChange={setOpen}
        className="mt-2 space-y-2">
        <div className="flex w-[300px] items-center justify-between space-x-4 px-2">
          <p className="p-5 text-xl font-bold text-white">
            Datos de la reserva
          </p>
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

      <div className="rounded-md border px-2 py-3 text-base">
        <ReservaDetailLabel
          title="Reserva Nro."
          label={reserva.id}
          isValidating={isValidating}
        />
        <ReservaDetailLabel
          title="A nombre de"
          label={`${reserva.cliente?.apellido}, ${reserva.cliente?.nombre}.`}
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
        {reserva?.estado_actual?.estado_id === RESERVA_PAGADA_ID ? (
          <>
            <ReservaDetailLabel
              title="Total"
              label={`${new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(reserva?.pagos[0].total)}`}
              isValidating={isValidating}
            />
            <ReservaDetailLabel
              title="Método de pago"
              label={reserva?.pagos[0].metodo_pago?.descripcion}
              isValidating={isValidating}
            />
            <ReservaDetailLabel
              title="Tier persona"
              label={reserva?.pagos[0].tipo_persona?.descripcion ?? '-'}
              isValidating={isValidating}
            />
          </>
        ) : (
          <ReservaDetailLabel
            title="Total"
            label={new Intl.NumberFormat('es-AR', {
              style: 'currency',
              currency: 'ARS',
            }).format(reserva?.precio_total)}
            isValidating={isValidating}
          />
        )}
        <Separator className="my-2 w-full" />
        <ReservaDetailLabel
          title="Comentario"
          label={reserva?.comentario}
          isValidating={isValidating}
        />
      </div>

      <p className="p-5 text-xl font-bold text-white">Acciones</p>

      <ReservaDetailActions
        reserva={reserva}
        reservaId={params.id}
        estadoId={reserva?.estado_actual?.estado_id}
      />

      {/* <Separator className="mt-8 w-full" /> */}
      <p className="p-5 text-xl font-bold text-white">Equipos</p>

      <ReservaEquipoList
        reservaId={params.id}
        estadoId={reserva?.estado_actual?.estado_id}
      />

      {/* <Separator className="mt-8 w-full" /> */}
      <p className="p-5 text-xl font-bold text-white">Traslados</p>

      <ReservaTrasladoList
        reserva={reserva}
        reservaId={params.id}
        estadoId={reserva?.estado_actual?.estado_id}
      />
    </div>
  )
}
