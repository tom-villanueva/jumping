'use server'
import { z } from 'zod'
import { revalidateTag } from 'next/cache'
import { fromErrorToFormState, toFormState } from '@/lib/utils'
import {
  deleteTipoArticulo,
  storeTipoArticulo,
  updateTipoArticulo,
} from '@/services/tipo-articulos'

const talleSchema = z.object({
  talle_id: z.number(),
  stock: z.number(),
})

const tipoArticuloSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  talle_ids: z.array(talleSchema).nullable(),
})

export async function saveTipoArticulo(selected, formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const tipoArticulo = tipoArticuloSchema.parse({
      descripcion: data.descripcion,
      talle_ids:
        selected.length > 0
          ? selected.map(talle => ({ talle_id: talle.id, stock: talle.stock }))
          : null,
    })

    const res = await storeTipoArticulo(tipoArticulo)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('tipo-articulos')

  return toFormState('SUCCESS', 'Tipo de artículo guardado con éxito')
}

export async function editTipoArticulo(selected, formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const tipoArticulo = tipoArticuloSchema.parse({
      descripcion: data.descripcion,
      talle_ids:
        selected.length > 0
          ? selected.map(talle => ({ talle_id: talle.id, stock: talle.stock }))
          : null,
    })

    const res = await updateTipoArticulo(data.tipoArticuloId, tipoArticulo)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('tipo-articulos')

  return toFormState('SUCCESS', 'Tipo de artículo editado con éxito.')
}

export async function removeTipoArticulo(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const res = await deleteTipoArticulo(data.entityId)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('tipo-articulos')

  return toFormState('SUCCESS', 'Tipo de artículo eliminado con éxito.')
}
