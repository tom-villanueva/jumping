import { useState } from 'react'
import ReservaMarcarComoPagadaDialog from './ReservaMarcarComoPagadaDialog'
import { Button } from '@/components/ui/button'
import { RESERVA_PAGADA_ID } from '@/lib/utils'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useRouter } from 'next/navigation'

export default function ReservaDetailActions({ reservaId, estadoId }) {
  const [openPagar, setOpenPagar] = useState(false)
  const [openExtender, setOpenExtender] = useState(false)
  const [openEliminar, setOpenEliminar] = useState(false)

  const router = useRouter()

  return (
    <div className="mt-8 flex flex-col gap-2 rounded-md border px-2 py-3 text-base">
      <h2>Acciones</h2>
      <div className="flex flex-row justify-between">
        <Button
          type="button"
          disabled={estadoId === RESERVA_PAGADA_ID}
          onClick={() => setOpenPagar(true)}>
          Marcar como paga
        </Button>

        <Button type="button" onClick={() => setOpenExtender(true)}>
          Extender reserva
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
    </div>
  )
}
