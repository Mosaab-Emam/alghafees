import { Link } from "@inertiajs/react";
import { Logo } from "../assets/icons";

export default function WebsiteLogo() {
    return (
        <Link className="2xl:pr-4" href="/">
            <Logo className="h-[56px] w-[148px] lg:h-[60px] lg:w-[140px] xl:h-[88.548px] xl:w-[180px]" />
        </Link>
    );
}
