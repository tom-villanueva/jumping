import Link from 'next/link'
import { Menu } from '@headlessui/react'

const DropdownLink = ({ children, ...props }) => (
  <Menu.Item>
    {({ active }) => (
      <Link
        {...props}
        className={`block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 ${
          active ? 'bg-gray-100' : ''
        } transition duration-150 ease-in-out focus:outline-none`}>
        {children}
      </Link>
    )}
  </Menu.Item>
)

export const DropdownButton = ({ children, ...props }) => (
  <Menu.Item>
    {({ active }) => (
      <button
        className={`block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 ${
          active ? 'bg-gray-100' : ''
        } transition duration-150 ease-in-out focus:outline-none`}
        {...props}>
        {children}
      </button>
    )}
  </Menu.Item>
)

export default DropdownLink
