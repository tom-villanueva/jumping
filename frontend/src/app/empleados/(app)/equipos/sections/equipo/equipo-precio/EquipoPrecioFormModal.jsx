'use client'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import EquipoPrecioForm from './EquipoPrecioForm'
import EquipoPrecioTable from './EquipoPrecioTable'

export default function EquipoPrecioFormModal({
  open,
  onOpenChange,
  equipo,
  preciosVigentes,
}) {
  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-screen overflow-y-auto sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>{`Agregar precio a equipo: ${equipo?.descripcion}`}</DialogTitle>
          <DialogDescription>
            Completar los datos. Apretar guardar cuando termines. <br />
            ⚠️ Si un precio tiene reservas asociadas al momento de borrarlo, la
            reserva igual mantendrá el precio.
          </DialogDescription>
        </DialogHeader>
        <div className="flex flex-col justify-between">
          <EquipoPrecioForm equipo={equipo} />
          <EquipoPrecioTable equipo={equipo} precios={preciosVigentes} />
        </div>
      </DialogContent>
    </Dialog>
  )
}
