'use client'
import { useFormState } from 'react-dom'
import { removeEquipo } from '../../actions'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import { useEffect } from 'react'
import SubmitButton from '@/components/SubmitButton'

export default function DeleteEquipoForm({
  openDeleteForm,
  setOpenDeleteForm,
  equipo,
}) {
  const [formState, action] = useFormState(removeEquipo, EMPTY_FORM_STATE)

  useEffect(() => {
    if (formState.status === 'SUCCESS') {
      setOpenDeleteForm(false)
    }
  }, [formState])

  return (
    <Dialog open={openDeleteForm} onOpenChange={() => setOpenDeleteForm(!open)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Eliminar Equipo</DialogTitle>
          <DialogDescription>
            Se eliminará permanentemente el equipo.
          </DialogDescription>
        </DialogHeader>
        <form action={action}>
          <input type="hidden" name="equipoId" value={equipo?.id} />
          <SubmitButton
            variant="destructive"
            label="Confirmar"
            className="w-full"
          />
        </form>
      </DialogContent>
    </Dialog>
  )
}
