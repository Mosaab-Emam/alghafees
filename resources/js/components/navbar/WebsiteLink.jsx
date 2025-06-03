import { Link, router } from "@inertiajs/react";
import { useState } from "react";

export default function WebsiteLink({ to = "/", children, onClick }) {
    const [isHovered, setIsHovered] = useState(false);
    const isActive = location.pathname === to;

    return (
        <Link
            onClick={(e) => {
                onClick?.(e);
            }}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
            className={`w-full h-full flex md:justify-center justify-start md:items-center items-center xl:gap-[6px] lg:gap-1 gap-[10px] text-sm font-normal md:border border-b pb-6 md:py-2 transition-all duration-400 ease-in-out
  ${
      router.page?.url === to
          ? "text-primary-500 font-medium md:border-[#ECECEC] border-primary-600"
          : "text-Gray-scale-02 hover:text-primary-500 hover:font-medium border-[#ECECEC]"
  }`}
            href={to}
        >
            {(isActive || isHovered) && (
                <span className="w-[6px] h-[6px] rounded-full bg-primary-500 transition-transform duration-400 ease-in-out scale-100"></span>
            )}
            {children}
        </Link>
    );
}
