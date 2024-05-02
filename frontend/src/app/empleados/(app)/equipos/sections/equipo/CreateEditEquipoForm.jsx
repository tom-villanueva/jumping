'use client'
import { editEquipo, saveEquipo } from '../../actions'
import EquipoFormContent from './EquipoFormContent'
import { EquipoTipoArticuloContextProvider } from './EquipoTipoArticuloContext'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'

export default function CreateEditEquipoForm({
  open,
  setOpen,
  onOpenChange = () => {},
  editing = false,
  tipoArticulos,
  onFormSubmit = () => {},
  equipo = {},
}) {
  return (
    <Dialog open={open} onOpenChange={() => setOpen(!open)}>
      <DialogContent className="sm:max-w-lg">
        <DialogHeader>
          <DialogTitle>
            {editing ? 'Agregar equipo' : 'Editar equipo'}
          </DialogTitle>
          <DialogDescription>
            Rellenar todos los datos. Apretar guardar cuando termines.
          </DialogDescription>
        </DialogHeader>
        <EquipoTipoArticuloContextProvider
          tipoArticulos={tipoArticulos}
          defaultSelected={equipo?.equipo_tipo_articulo?.map(
            // Le saco el atributo pivot
            ({ pivot, ...rest }) => rest,
          )}>
          <EquipoFormContent
            onFormSubmit={() => setOpen(!open)}
            equipo={equipo}
            serverAction={editing ? editEquipo : saveEquipo}
          />
        </EquipoTipoArticuloContextProvider>
      </DialogContent>
    </Dialog>
  )
}
