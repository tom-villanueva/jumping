'use server'
import { z } from 'zod'
import { revalidateTag } from 'next/cache'
import { fromErrorToFormState, toFormState } from '@/lib/utils'
import { deleteTalle, storeTalle, updateTalle } from '@/services/talles'

const tipoArticuloSchema = z.object({
  tipo_articulo_id: z.number(),
})

const talleSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  tipo_articulo_ids: z.array(tipoArticuloSchema).nullable(),
})

export async function saveTalle(selected, formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const talle = talleSchema.parse({
      descripcion: data.descripcion,
      tipo_articulo_ids:
        selected.length > 0
          ? selected.map(tipo_articulo => ({
              tipo_articulo_id: tipo_articulo.id,
            }))
          : null,
    })

    const res = await storeTalle(talle)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('talles')

  return toFormState('SUCCESS', 'Talle guardado con éxito')
}

export async function editTalle(selected, formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const talle = talleSchema.parse({
      descripcion: data.descripcion,
      tipo_articulo_ids:
        selected.length > 0
          ? selected.map(tipo_articulo => ({
              tipo_articulo_id: tipo_articulo.id,
            }))
          : null,
    })

    const res = await updateTalle(data.talleId, talle)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('talles')

  return toFormState('SUCCESS', 'Talle editado con éxito.')
}

export async function removeTalle(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const res = await deleteTalle(data.entityId)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('talles')

  return toFormState('SUCCESS', 'Talle eliminado con éxito.')
}
