'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import ReservaCrearVoucherForm from './ReservaCrearVoucherForm'

export default function ReservaCrearVoucherDialog({
  openForm,
  setOpenForm,
  reservaId,
  reserva,
}) {
  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[600px]">
        <DialogHeader>
          <DialogTitle>
            Crear voucher a partir de la reserva Nro. {reservaId}
          </DialogTitle>
          <DialogDescription>
            Seleccionar los equipos para voucher.
          </DialogDescription>
        </DialogHeader>
        <ReservaCrearVoucherForm
          reservaId={reservaId}
          onFormSubmit={() => {
            setOpenForm(!openForm)
          }}
          reserva={reserva}
        />
      </DialogContent>
    </Dialog>
  )
}
