import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import EquipoForm from './EquipoForm'
import Button from '@/components/Button'
import { getTipoArticulos } from '@/services/tipo-articulos'

export default async function CreateEquipoForm() {
  const tipoArticulos = await getTipoArticulos()

  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button variant="outline">Agregar Equipo</Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Agregar Equipo</DialogTitle>
          <DialogDescription>
            Rellenar todos los datos. Apretar guardar cuando termines.
          </DialogDescription>
        </DialogHeader>
        <EquipoForm tipoArticulos={tipoArticulos} />
      </DialogContent>
    </Dialog>
  )
}
