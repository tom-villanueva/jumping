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
  { id: 6, name: 'clientes' },
  { id: 7, name: 'traslados' },
]

const dropdownRoutes = [
  { id: 8, name: 'usuarios' },
  { id: 9, name: 'vouchers' },
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
            <div className="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex ">
              {routes.map(route => (
                <NavLink
                  key={route.id}
                  href={`/empleados/${route.name}`}
                  active={pathname.startsWith(`/empleados/${route.name}`)}>
                  {capitalize(route.name)}
                </NavLink>
              ))}

              {/* More links Dropdown */}
              <div className="hidden lg:ml-6 lg:flex lg:items-center">
                <Dropdown
                  align="right"
                  width="48"
                  trigger={
                    <button className="flex items-center text-sm font-medium text-slate-400 transition duration-150 ease-in-out hover:text-red-400 focus:outline-none">
                      <div>Más</div>

                      <div className="ml-1">
                        <ChevronDown className="w-4" />
                      </div>
                    </button>
                  }>
                  {dropdownRoutes.map(route => (
                    <DropdownButton key={route.id}>
                      <NavLink
                        href={`/empleados/${route.name}`}
                        active={pathname.startsWith(
                          `/empleados/${route.name}`,
                        )}>
                        {capitalize(route.name)}
                      </NavLink>
                    </DropdownButton>
                  ))}
                </Dropdown>
              </div>
            </div>
          </div>

          {/* Settings Dropdown */}
          <div className="hidden lg:ml-6 lg:flex lg:items-center">
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
          <div className="-mr-2 flex items-center lg:hidden">
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
        <div className="block lg:hidden">
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
