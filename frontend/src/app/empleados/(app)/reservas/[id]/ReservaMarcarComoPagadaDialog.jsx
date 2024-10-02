'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import ReservaMarcarComoPagadaForm from './ReservaMarcarComoPagadaForm'

export default function ReservaMarcarComoPagadaDialog({
  openForm,
  setOpenForm,
  reservaId,
}) {
  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>
            Marcar como paga la reserva Nro. {reservaId}
          </DialogTitle>
          <DialogDescription>
            Se marcará con estado "pagada" la reserva y se generará un pago.
          </DialogDescription>
        </DialogHeader>
        <ReservaMarcarComoPagadaForm
          reservaId={reservaId}
          onFormSubmit={() => setOpenForm(!openForm)}
        />
      </DialogContent>
    </Dialog>
  )
}
