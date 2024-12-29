import DropdownButton from "@/Components/DropdownButton";
import WebsiteLink from "@/Components/WebsiteLink";

const WebsiteLinks = ({
    links,
    hideDropdown = false,
}: {
    links: Array<{ id: number; name: string; to: string }>;
    hideDropdown?: boolean;
}) => {
    return (
        <div
            className={`hidden md:flex justify-between items-center h-[50px] ${
                hideDropdown ? "lg:min-w-full " : "lg:min-w-[575px]"
            } xl:min-w-[705px] bg-bg-01`}
        >
            {links.map((link) => (
                <WebsiteLink key={link.id} to={link.to} onClick={() => {}}>
                    {link.name}
                </WebsiteLink>
            ))}
            {hideDropdown ? null : <DropdownButton />}
        </div>
    );
};

export default WebsiteLinks;
