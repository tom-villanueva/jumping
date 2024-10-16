'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import ReservaExtenderFechasForm from './ReservaExtenderFechasForm'

export default function ReservaExtenderFechasDialog({
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
            Extender fechas de la reserva Nro. {reservaId}
          </DialogTitle>
          <DialogDescription>
            Funciona para extender las fecha y recalcular los precios de los
            equipos.
          </DialogDescription>
        </DialogHeader>
        <ReservaExtenderFechasForm
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
