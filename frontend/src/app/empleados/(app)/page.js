import { redirect } from 'next/navigation'

export default function page() {
  redirect('/empleados/dashboard')
  return <>Redirigiendo...</>
}
