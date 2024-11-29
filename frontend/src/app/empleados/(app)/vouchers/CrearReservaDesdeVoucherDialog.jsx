'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import CrearReservaDesdeVoucherForm from './CrearReservaDesdeVoucherForm'

export default function CrearReservaDesdeVoucherDialog({
  openForm,
  setOpenForm,
  voucher,
}) {
  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[600px]">
        <DialogHeader>
          <DialogTitle>Crear reserva a partir de voucher</DialogTitle>
          <DialogDescription>
            Llene los campos y presione guardar.
          </DialogDescription>
        </DialogHeader>
        <CrearReservaDesdeVoucherForm voucher={voucher} />
      </DialogContent>
    </Dialog>
  )
}
