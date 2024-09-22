// import axios from 'axios'
import { clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'
import { ZodError } from 'zod'
import axios from './axios'

export function cn(...inputs) {
  return twMerge(clsx(inputs))
}

/**
 * status: UNSET | SUCCESS | ERROR
 */
export const EMPTY_FORM_STATE = {
  status: 'UNSET',
  message: '',
  fieldErrors: {},
  timestamp: Date.now(),
}

export const toFormState = (status, message) => {
  return {
    status,
    message,
    fieldErrors: {},
    timestamp: Date.now(),
  }
}

export class CustomValidationError extends Error {
  constructor(message, errors) {
    super(message)
    this.name = 'CustomValidationError'
    this.errors = errors
  }
}

// export const fromErrorToFormState = error => {
//   // validación de Next
//   if (error instanceof ZodError) {
//     return {
//       status: 'ERROR',
//       message: '',
//       fieldErrors: error.flatten().fieldErrors,
//       timestamp: Date.now(),
//     }
//     // validación de Laravel desde axios
//   } else if (axios.isAxiosError(error)) {
//     return {
//       status: 'ERROR',
//       message: error?.response?.data?.message ?? error?.message,
//       fieldErrors: error?.response?.data?.errors ?? {},
//       timestamp: Date.now(),
//     }
//     // validación de Laravel pero desde fetch
//   } else if (error instanceof CustomValidationError) {
//     return {
//       status: 'ERROR',
//       message: error.message,
//       fieldErrors: error.errors,
//       timestamp: Date.now(),
//     }
//     // Se chingó otra cosa
//   } else {
//     return {
//       status: 'ERROR',
//       message: 'Ha ocurrido un error inesperado.',
//       fieldErrors: {},
//       timestamp: Date.now(),
//     }
//   }
// }

export const formatDate = date => {
  const year = date.getFullYear()
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const day = String(date.getDate()).padStart(2, '0')
  return `${year}-${month}-${day}`
}

export const convertToUTC = date => {
  const localDate = new Date(date)
  const offset = localDate.getTimezoneOffset()
  const utcTimestamp = localDate.getTime() + offset * 60 * 1000
  return new Date(utcTimestamp)
}

export const fetcher = ([url, qs]) =>
  axios.get(`${url}?${qs}`).then(res => {
    return res.data
  })

// https://swr.vercel.app/docs/mutation#useswrmutation
export async function storeFetcher(url, { arg }) {
  await axios.post(url, arg.data)
}

export async function updateFetcher(url, { arg }) {
  await axios.put(`${url}/${arg.id}`, arg.data)
}

export async function deleteFetcher(url, { arg }) {
  await axios.delete(`${url}/${arg.id}`)
}

export const chartColors = [
  '#FF6B6B', // Soft Red
  '#4ECDC4', // Aqua Blue
  '#1A535C', // Dark Cyan
  '#F7FFF7', // Off White
  '#FFE66D', // Soft Yellow
  '#FF9F1C', // Bright Orange
  '#2EC4B6', // Teal
  '#011627', // Deep Navy
  '#FF3366', // Vibrant Pink
  '#33658A', // Deep Sky Blue
  '#55DDE0', // Cyan
  '#FFBE0B', // Golden Yellow
  '#3A86FF', // Bright Blue
  '#8338EC', // Purple
  '#FB5607', // Tangerine
  '#FF006E', // Magenta
  '#06D6A0', // Mint Green
  '#FFD166', // Sunset Orange
  '#118AB2', // Bright Blue
  '#073B4C', // Dark Teal
]
