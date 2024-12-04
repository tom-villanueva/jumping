'use client'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { cn } from '@/lib/utils'

export default function CreateEditEntityModal({
  open,
  onOpenChange = () => {},
  editing = false,
  name,
  className = '',
  children,
}) {
  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent
        className={cn('max-h-screen overflow-y-auto sm:max-w-lg', className)}>
        <DialogHeader>
          <DialogTitle>
            {editing ? `Editar ${name}` : `Crear ${name}`}
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
