import { DropdownButton } from "..";
import WebsiteLink from "./WebsiteLink";

export default function WebsiteLinks({ links, hideDropdown = false }) {
    return (
        <div
            className={`hidden grow md:flex justify-between items-center h-[50px] ${
                hideDropdown ? "lg:min-w-full " : "lg:min-w-[575px]"
            } xl:min-w-[705px] bg-bg-01 mb-8`}
        >
            {links.map((link) => (
                <WebsiteLink key={link.id} to={link.to}>
                    {link.name}
                </WebsiteLink>
            ))}
            {hideDropdown ? null : <DropdownButton />}
        </div>
    );
}
