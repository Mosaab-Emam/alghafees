import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { LeftCircleShape, TextContent } from "../../../components";

const ClientsBoxTwo = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="md:mt-[175px] mt-[270px]">
            <div className="md:-mb-[35px] mb-[60px] flex items-center justify-center mx-auto relative">
                <LeftCircleShape position="md:left-[-100px] -left-10 md:top-[-65px] -top-6" />
                <TextContent width={"w-[243px]"} align="text-center">
                    <span
                        dangerouslySetInnerHTML={{
                            __html: static_content["clients_title"],
                        }}
                    />
                </TextContent>
            </div>
        </section>
    );
};

export default ClientsBoxTwo;
