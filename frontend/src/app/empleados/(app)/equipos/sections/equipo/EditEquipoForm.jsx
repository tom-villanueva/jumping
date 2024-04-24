'use client'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import EquipoForm from './EquipoForm'
import { editEquipo } from '../../actions'

export default function EditEquipoForm({
  tipoArticulos,
  equipo,
  openEditForm,
  setOpenEditForm,
}) {
  return (
    <Dialog open={openEditForm} onOpenChange={() => setOpenEditForm(!open)}>
      {/* <DialogTrigger asChild>
        <Button variant="outline">Agregar Equipo</Button>
      </DialogTrigger> */}
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Editar Equipo</DialogTitle>
          <DialogDescription>
            Rellenar todos los datos. Apretar guardar cuando termines.
          </DialogDescription>
        </DialogHeader>
        <EquipoForm
          tipoArticulos={tipoArticulos}
          closeDialog={() => setOpenEditForm(false)}
          equipo={equipo}
          serverAction={editEquipo}
        />
      </DialogContent>
    </Dialog>
  )
}
