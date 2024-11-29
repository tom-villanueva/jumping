import { useState } from 'react'
import ReservaMarcarComoPagadaDialog from './ReservaMarcarComoPagadaDialog'
import { Button } from '@/components/ui/button'
import { RESERVA_PAGADA_ID } from '@/lib/utils'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useRouter } from 'next/navigation'
import ReservaExtenderDialog from './ReservaExtenderDialog'
import ReservaExtenderFechasDialog from './ReservaExtenderFechasDialog'
import ReservaVerDesgloseDePreciosDialog from './ReservaVerDesgloseDePreciosDialog'
import Link from 'next/link'
import ReservaEnviarMailContratoDialog from './ReservaEnviarMailContratoDialog'
import {
  CalendarClock,
  CircleDollarSign,
  Copy,
  CreditCard,
  HandCoins,
  Mail,
  ReceiptText,
  TicketPercentIcon,
  Trash,
} from 'lucide-react'
import ReservaEnviarMailConfirmacionDialog from './ReservaEnviarMailConfirmacionDialog'
import ReservaCrearVoucherDialog from './ReservaCrearVoucherDialog'

export default function ReservaDetailActions({ reservaId, estadoId, reserva }) {
  const [openPagar, setOpenPagar] = useState(false)
  const [openExtender, setOpenExtender] = useState(false)
  const [openEliminar, setOpenEliminar] = useState(false)
  const [openExtenderFechas, setOpenExtenderFechas] = useState(false)
  const [openDesglosePrecios, setOpenDesglosePrecios] = useState(false)
  const [openEnviarContrato, setOpenEnviarContrato] = useState(false)
  const [openEnviarConfirmacion, setOpenEnviarConfirmacion] = useState(false)
  const [openCrearVoucher, setOpenCrearVoucher] = useState(false)

  const router = useRouter()

  return (
    <div>
      <div className="mb-8 flex flex-col gap-2 rounded-md border px-2 py-3 text-base">
        <div className="flex flex-row flex-wrap justify-normal gap-2">
          <Button
            type="button"
            disabled={estadoId === RESERVA_PAGADA_ID}
            onClick={() => setOpenPagar(true)}>
            <HandCoins className="mr-2 h-4 w-4" />
            Marcar como paga
          </Button>

          <Button
            type="button"
            variant="secondary"
            disabled={estadoId === RESERVA_PAGADA_ID}
            onClick={() => setOpenExtenderFechas(true)}>
            <CalendarClock className="mr-2 h-4 w-4" />
            Modificar fechas
          </Button>

          <Button
            variant="secondary"
            type="button"
            onClick={() => setOpenDesglosePrecios(true)}>
            <CircleDollarSign className="mr-2 h-4 w-4" />
            Ver desglose de precios
          </Button>

          <Button
            variant="secondary"
            type="button"
            onClick={() => setOpenCrearVoucher(true)}>
            <TicketPercentIcon className="mr-2 h-4 w-4" />
            Crear voucher
          </Button>
        </div>
      </div>

      <div className="mb-8 flex flex-col gap-2 rounded-md border px-2 py-3 text-base">
        <div className="flex flex-row flex-wrap justify-normal gap-2">
          <Button type="button" asChild>
            <Link
              target="_blank"
              href={`${process.env.NEXT_PUBLIC_BACKEND_URL}/api/reservas/contrato?reserva_id=${reservaId}`}>
              <ReceiptText className="mr-2 h-4 w-4" />
              Imprimir Contrato
            </Link>
          </Button>

          <Button type="button" onClick={() => setOpenEnviarContrato(true)}>
            <Mail className="mr-2 h-4 w-4" />
            Enviar contrato
          </Button>

          <Button type="button" onClick={() => setOpenEnviarConfirmacion(true)}>
            <Mail className="mr-2 h-4 w-4" />
            Reenviar confirmación
          </Button>
        </div>
      </div>

      <div className="mb-8 flex flex-col gap-2 rounded-md border border-red-500 px-2 py-3 text-base">
        <div className="flex flex-row flex-wrap justify-normal gap-2">
          <Button type="button" onClick={() => setOpenExtender(true)}>
            <Copy className="mr-2 h-4 w-4" />
            Copiar
          </Button>

          <Button
            type="button"
            variant="destructive"
            disabled={estadoId === RESERVA_PAGADA_ID}
            onClick={() => setOpenEliminar(true)}>
            <Trash className="mr-2 h-4 w-4" />
            Eliminar
          </Button>
        </div>
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
        reserva={reserva}
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

      <ReservaEnviarMailContratoDialog
        openForm={openEnviarContrato}
        setOpenForm={setOpenEnviarContrato}
        reservaId={reservaId}
        reserva={reserva}
      />

      <ReservaEnviarMailConfirmacionDialog
        openForm={openEnviarConfirmacion}
        setOpenForm={setOpenEnviarConfirmacion}
        reservaId={reservaId}
        reserva={reserva}
      />

      <ReservaCrearVoucherDialog
        openForm={openCrearVoucher}
        setOpenForm={setOpenCrearVoucher}
        reservaId={reservaId}
        reserva={reserva}
      />
    </div>
  )
}
