'use server'

import { z } from 'zod'
import {
  deleteEquipo,
  deleteEquipoDescuento,
  storeEquipo,
  storeEquipoDescuento,
  updateEquipo,
  updateEquipoDescuento,
  updateEquipoDescuentos,
  uploadEquipoThumbnail,
} from '@/services/equipos'
import { revalidateTag } from 'next/cache'
import { convertToUTC, fromErrorToFormState, toFormState } from '@/lib/utils'

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

const equipoDescuentoSchema = z
  .object({
    equipo_id: z.number(),
    descuento_id: z
      .string({
        required_error: 'Debe elegir un descuento',
      })
      .min(1, 'Debe elegir un talle'),
    fecha_desde: z
      .string({
        required_error: 'Se requiere fecha inicio',
      })
      .date('Se requiere fecha inicio')
      .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
        message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
      }),
    fecha_hasta: z
      .string({
        required_error: 'Se requiere fecha fin',
      })
      .date('Se requiere fecha fin'),
  })
  .refine(
    data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
    {
      message: 'Fecha fin no puede ser menor a fecha inicio',
      path: ['fecha_hasta'],
    },
  )

export async function addEquipoDescuento(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const descuento = equipoDescuentoSchema.parse({
      equipo_id: Number(data?.equipoId),
      descuento_id: data.descuentoId,
      fecha_desde: data.fecha_desde,
      fecha_hasta: data.fecha_hasta,
    })

    console.log({ descuento })

    const res = await storeEquipoDescuento(descuento)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return {
    status: 'SUCCESS',
    message: 'Descuento agregado con éxito.',
    fieldErrors: {},
    timestamp: Date.now(),
  }
}

const equipoDescuentoEditSchema = z
  .object({
    id: z.number(),
    equipo_id: z.number(),
    descuento_id: z
      .string({
        required_error: 'Debe elegir un descuento',
      })
      .min(1, 'Debe elegir un talle'),
    fecha_desde: z
      .string({
        required_error: 'Se requiere fecha inicio',
      })
      .date('Se requiere fecha inicio')
      .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
        message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
      }),
    fecha_hasta: z
      .string({
        required_error: 'Se requiere fecha fin',
      })
      .date('Se requiere fecha fin'),
  })
  .refine(
    data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
    {
      message: 'Fecha fin no puede ser menor a fecha inicio',
      path: ['fecha_hasta'],
    },
  )

export async function editEquipoDescuento(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const descuento = equipoDescuentoEditSchema.parse({
      id: Number(data?.equipoDescuentoId),
      equipo_id: Number(data?.equipoId),
      descuento_id: data.descuentoId,
      fecha_desde: data.fecha_desde,
      fecha_hasta: data.fecha_hasta,
    })

    console.log({ descuento })

    const res = await updateEquipoDescuento(data?.equipoDescuentoId, descuento)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return {
    status: 'SUCCESS',
    message: 'Descuento actualizado con éxito.',
    fieldErrors: {},
    timestamp: Date.now(),
  }
}

export async function removeEquipoDescuento(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const res = await deleteEquipoDescuento(data.entityId)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('equipos')

  return toFormState('SUCCESS', 'Descuento eliminado con éxito.')
}
