'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import ReservaExtenderForm from './ReservaExtenderForm'

export default function ReservaExtenderDialog({
  openForm,
  setOpenForm,
  reservaId,
  reserva,
}) {
  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[600px]">
        <DialogHeader>
          <DialogTitle>Extender la reserva Nro. {reservaId}</DialogTitle>
          <DialogDescription>
            Funciona para extender la reserva o crear una reserva a partir de
            esta reserva.
          </DialogDescription>
        </DialogHeader>
        <ReservaExtenderForm
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
