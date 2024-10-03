'use client'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import EquipoDescuentoForm from './EquipoDescuentoForm'
import EquipoDescuentoTable from './EquipoDescuentoTable'

export default function EquipoDescuentoFormModal({
  open,
  onOpenChange,
  equipo,
  descuentos,
  descuentosVigentes,
}) {
  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-screen overflow-y-auto sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>{`Agregar descuentos a equipo: ${equipo?.descripcion}`}</DialogTitle>
          <DialogDescription>
            Completar los datos. Apretar guardar cuando termines.
          </DialogDescription>
        </DialogHeader>
        <div className="flex flex-col justify-between">
          <EquipoDescuentoForm equipo={equipo} descuentos={descuentos} />
          <EquipoDescuentoTable
            equipo={equipo}
            descuentosAll={descuentos}
            descuentos={descuentosVigentes}
          />
        </div>
      </DialogContent>
    </Dialog>
  )
}
