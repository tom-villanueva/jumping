'use client'
import { useFormState } from 'react-dom'
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
import { useToast } from '@/components/ui/use-toast'

export default function DeleteEntityForm({
  openDeleteForm,
  setOpenDeleteForm,
  entity,
  serverAction,
  name,
}) {
  const [formState, action] = useFormState(serverAction, EMPTY_FORM_STATE)
  const { toast } = useToast()

  useEffect(() => {
    if (formState.status === 'SUCCESS') {
      toast({
        title: `😄 ${formState.message}`,
      })
      setOpenDeleteForm(false)
    } else if (formState.status === 'ERROR') {
      toast({
        title: `🥲 ${formState.message}`,
        description: 'Intente de nuevo más tarde.',
        variant: 'destructive',
      })
      setOpenDeleteForm(false)
    }
  }, [formState])

  return (
    <Dialog open={openDeleteForm} onOpenChange={() => setOpenDeleteForm(!open)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Eliminar {name}</DialogTitle>
          <DialogDescription>
            Se eliminará permanentemente el {name}.
          </DialogDescription>
        </DialogHeader>
        <form action={action}>
          <input type="hidden" name="entityId" value={entity?.id} />
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
