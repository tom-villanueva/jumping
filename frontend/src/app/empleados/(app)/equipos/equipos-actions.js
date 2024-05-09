'use server'

import { z } from 'zod'
import {
  deleteEquipo,
  storeEquipo,
  updateEquipo,
  uploadEquipoThumbnail,
} from '@/services/equipos'
import { revalidateTag } from 'next/cache'
import { fromErrorToFormState, toFormState } from '@/lib/utils'

const tipoArticuloSchema = z.object({
  tipo_articulo_id: z.number(),
})

const equipoSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  precio: z
    .number({
      required_error: 'Se requiere precio',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  disponible: z.boolean(),
  tipo_articulo_ids: z.array(tipoArticuloSchema).nullable(),
})

export async function saveEquipo(selected, formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const equipo = equipoSchema.parse({
      descripcion: data.descripcion,
      precio: parseInt(data.precio),
      disponible: data.disponible.toLowerCase() === 'true',
      tipo_articulo_ids:
        selected.length > 0
          ? selected.map(tipo => ({ tipo_articulo_id: tipo.id }))
          : [],
    })

    const res = await storeEquipo(equipo)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return toFormState('SUCCESS', 'Equipo guardado con éxito')
}

export async function editEquipo(selected, formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const equipo = equipoSchema.parse({
      descripcion: data.descripcion,
      precio: parseInt(data.precio),
      disponible: data.disponible.toLowerCase() === 'true',
      tipo_articulo_ids:
        selected.length > 0
          ? selected.map(tipo => ({ tipo_articulo_id: tipo.id }))
          : [],
    })

    const res = await updateEquipo(data.equipoId, equipo)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return toFormState('SUCCESS', 'Equipo editado con éxito.')
}

export async function removeEquipo(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const res = await deleteEquipo(data.entityId)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return toFormState('SUCCESS', 'Equipo eliminado con éxito.')
}

const MAX_FILE_SIZE = 1024 * 1024 // 1mb
const ACCEPTED_IMAGE_TYPES = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/webp',
]

const uploadEquipoThumbnailSchema = z.object({
  thumbnail: z
    .any()
    .refine(file => file?.size !== 0, 'Seleccione una imagen.')
    .refine(file => file?.size <= MAX_FILE_SIZE, `Tamaño máximo es 1MB.`)
    .refine(
      file => ACCEPTED_IMAGE_TYPES.includes(file?.type),
      'Se aceptan solo .jpg, .jpeg, .png and .webp',
    ),
})

export async function updateEquipoThumbnail(formState, formData) {
  let res
  try {
    const data = Object.fromEntries(formData)

    const equipo = uploadEquipoThumbnailSchema.parse({
      thumbnail: data?.thumb,
    })

    const payload = new FormData()
    payload.append('thumbnail', equipo?.thumbnail)

    res = await uploadEquipoThumbnail(data?.equipoId, payload)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return {
    status: 'SUCCESS',
    message: 'Thumbnail subido con éxito.',
    res,
    fieldErrors: {},
    timestamp: Date.now(),
  }
}
