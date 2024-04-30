'use client'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'

export default function CreateEditEntityModal({
  open,
  onOpenChange = () => {},
  editing = false,
  name,
  children,
}) {
  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="sm:max-w-lg">
        <DialogHeader>
          <DialogTitle>
            {editing ? `Editar ${name}` : `Nuevo ${name}`}
          </DialogTitle>
          <DialogDescription>
            Rellenar todos los datos. Apretar guardar cuando termines.
          </DialogDescription>
        </DialogHeader>
        {children}
      </DialogContent>
    </Dialog>
  )
}
