import { useState } from 'react'
import ReservaMarcarComoPagadaDialog from './ReservaMarcarComoPagadaDialog'
import { Button } from '@/components/ui/button'
import { RESERVA_PAGADA_ID } from '@/lib/utils'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useRouter } from 'next/navigation'
import ReservaExtenderDialog from './ReservaExtenderDialog'
import ReservaExtenderFechasDialog from './ReservaExtenderFechasDialog'
import ReservaVerDesgloseDePreciosDialog from './ReservaVerDesgloseDePreciosDialog'

export default function ReservaDetailActions({ reservaId, estadoId, reserva }) {
  const [openPagar, setOpenPagar] = useState(false)
  const [openExtender, setOpenExtender] = useState(false)
  const [openEliminar, setOpenEliminar] = useState(false)
  const [openExtenderFechas, setOpenExtenderFechas] = useState(false)
  const [openDesglosePrecios, setOpenDesglosePrecios] = useState(false)

  const router = useRouter()

  return (
    <div className="flex flex-col gap-2 rounded-md border px-2 py-3 text-base">
      <div className="flex flex-row flex-wrap justify-between gap-2">
        <Button
          type="button"
          disabled={estadoId === RESERVA_PAGADA_ID}
          onClick={() => setOpenPagar(true)}>
          Marcar como paga
        </Button>

        <Button
          type="button"
          disabled={estadoId === RESERVA_PAGADA_ID}
          onClick={() => setOpenExtenderFechas(true)}>
          Modificar fechas
        </Button>

        <Button type="button" onClick={() => setOpenExtender(true)}>
          Crear nueva reserva desde esta reserva
        </Button>

        <Button type="button" onClick={() => setOpenDesglosePrecios(true)}>
          Ver desglose de precios
        </Button>

        <Button type="button" onClick={() => setOpenExtender(true)}>
          Imprimir contrato
        </Button>

        <Button
          type="button"
          variant="destructive"
          disabled={estadoId === RESERVA_PAGADA_ID}
          onClick={() => setOpenEliminar(true)}>
          Eliminar reserva
        </Button>
      </div>

      <DeleteEntityForm
        openDeleteForm={openEliminar}
        setOpenDeleteForm={setOpenEliminar}
        entity={{ id: reservaId }}
        apiKey="/api/reservas"
        name="reserva"
        onFormSubmit={() => {
          router.replace('/empleados/reservas')
        }}
      />

      <ReservaMarcarComoPagadaDialog
        openForm={openPagar}
        setOpenForm={setOpenPagar}
        reservaId={reservaId}
      />

      <ReservaExtenderDialog
        openForm={openExtender}
        setOpenForm={setOpenExtender}
        reservaId={reservaId}
        reserva={reserva}
      />

      <ReservaExtenderFechasDialog
        openForm={openExtenderFechas}
        setOpenForm={setOpenExtenderFechas}
        reservaId={reservaId}
        reserva={reserva}
      />

      <ReservaVerDesgloseDePreciosDialog
        openForm={openDesglosePrecios}
        setOpenForm={setOpenDesglosePrecios}
        reservaId={reservaId}
        reserva={reserva}
      />
    </div>
  )
}
