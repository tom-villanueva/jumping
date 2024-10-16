import ApplicationLogo from '@/components/ApplicationLogo'
import Dropdown from '@/components/Dropdown'
import Link from 'next/link'
import NavLink from '@/components/NavLink'
import ResponsiveNavLink, {
  ResponsiveNavButton,
} from '@/components/ResponsiveNavLink'
import { DropdownButton } from '@/components/DropdownLink'
import { usePathname } from 'next/navigation'
import { useState } from 'react'
import { ChevronDown, MenuIcon, User } from 'lucide-react'

const routes = [
  { id: 1, name: 'dashboard' },
  { id: 2, name: 'reservas' },
  { id: 3, name: 'articulos' },
  { id: 4, name: 'equipos' },
  { id: 5, name: 'stock' },
  { id: 6, name: 'usuarios' },
]

function capitalize(word) {
  return word.charAt(0).toUpperCase() + word.slice(1)
}

const Navigation = ({ user, logout }) => {
  const [open, setOpen] = useState(false)
  const pathname = usePathname()

  return (
    <nav className="border-b border-gray-100 bg-slate-700">
      {/* Primary Navigation Menu */}
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="flex h-16 justify-between">
          <div className="flex">
            {/* Logo */}
            <div className="flex flex-shrink-0 items-center">
              <Link href="/empleados/dashboard">
                <ApplicationLogo className="block h-10 w-auto fill-current text-slate-400" />
              </Link>
            </div>

            {/* Navigation Links */}
            <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
              {routes.map(route => (
                <NavLink
                  key={route.id}
                  href={`/empleados/${route.name}`}
                  active={pathname.startsWith(`/empleados/${route.name}`)}>
                  {capitalize(route.name)}
                </NavLink>
              ))}
            </div>
          </div>

          {/* Settings Dropdown */}
          <div className="hidden sm:ml-6 sm:flex sm:items-center">
            <Dropdown
              align="right"
              width="48"
              trigger={
                <button className="flex items-center text-sm font-medium text-slate-400 transition duration-150 ease-in-out hover:text-red-400 focus:outline-none">
                  <div>{user?.name}</div>

                  <div className="ml-1">
                    <ChevronDown className="w-4" />
                  </div>
                </button>
              }>
              {/* Authentication */}
              <DropdownButton onClick={logout}>Cerrar Sesión</DropdownButton>
            </Dropdown>
          </div>

          {/* Hamburger */}
          <div className="-mr-2 flex items-center sm:hidden">
            <button
              onClick={() => setOpen(open => !open)}
              className="inline-flex items-center justify-center rounded-md p-2 text-black transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
              <MenuIcon className="w-4" />
            </button>
          </div>
        </div>
      </div>

      {/* Responsive Navigation Menu */}
      {open && (
        <div className="block sm:hidden">
          <div className="space-y-1 pb-3 pt-2">
            {routes.map(route => (
              <ResponsiveNavLink
                key={route.id}
                href={`/empleados/${route.name}`}
                active={pathname.startsWith(`/empleados/${route.name}`)}>
                {capitalize(route.name)}
              </ResponsiveNavLink>
            ))}
          </div>

          {/* Responsive Settings Options */}
          <div className="border-t border-gray-200 pb-1 pt-4">
            <div className="flex items-center px-4">
              <div className="flex-shrink-0">
                <User className="w-8" />
              </div>

              <div className="ml-3">
                <div className="text-base font-medium text-slate-400">
                  {user?.name}
                </div>
                <div className="text-sm font-medium text-slate-300">
                  {user?.email}
                </div>
              </div>
            </div>

            <div className="mt-3 space-y-1">
              {/* Authentication */}
              <ResponsiveNavButton onClick={logout}>
                Cerrar Sesión
              </ResponsiveNavButton>
            </div>
          </div>
        </div>
      )}
    </nav>
  )
}

export default Navigation
