import { Button, ParagraphContent } from "@/components";
import Container from "@/components/Container";
import Heading from "@/components/Heading";
import { staticContext } from "@/utils/contexts";
import { useContext, useEffect, useRef, useState } from "react";
import CTAApartmentIcon from "../assets/cta-apartment-icon.svg";

const CTASection = () => {
    const static_content = useContext<Record<string, string>>(staticContext);
    const ref = useRef<HTMLDivElement>(null);
    const [brRadius, setBrRadius] = useState<number>(0);
    const [tlRadius, setTlRadius] = useState<number>(0);

    useEffect(() => {
        setBrRadius(ref.current?.clientWidth! * 0.125);
        setTlRadius(ref.current?.clientWidth! * 0.125);
    }, [ref]);

    return (
        <Container>
            <section
                ref={ref}
                className="relative w-full bg-primary-600 overflow-hidden flex items-center justify-between py-8 px-16 mb-8"
                style={{
                    borderTopLeftRadius: `${tlRadius}px`,
                    borderBottomRightRadius: `${brRadius}px`,
                }}
            >
                <div className="flex flex-col">
                    <Heading
                        title={static_content["banner_title"]}
                        size={3}
                        className="text-bg-01 mb-2"
                    />
                    <h3 className="text-bg-01 head-line-h4 font-bold mb-2">
                        {static_content["banner_subtitle"]}
                    </h3>
                    <ParagraphContent
                        textColor="text-bg-01"
                        className="mb-4 max-w-[420px]"
                    >
                        <div
                            dangerouslySetInnerHTML={{
                                __html: static_content["banner_description"],
                            }}
                        />
                    </ParagraphContent>
                    <Button
                        variant=""
                        className="bg-bg-01 text-primary-600 font-bold px-8 py-3 border-2 border-bg-01 transition-all"
                    >
                        {static_content["banner_button_text"]}
                    </Button>
                </div>

                {/* Decorative moon shape */}
                <div className="absolute left-0 top-0 w-40 h-40 opacity-30">
                    <svg
                        width="100%"
                        height="100%"
                        viewBox="0 0 160 160"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <circle
                            cx="80"
                            cy="80"
                            r="80"
                            fill="white"
                            fillOpacity="0.2"
                        />
                        <circle
                            cx="80"
                            cy="80"
                            r="65"
                            fill="none"
                            stroke="white"
                            strokeWidth="6"
                            opacity="0.5"
                        />
                    </svg>
                </div>

                <img
                    src={CTAApartmentIcon}
                    alt="مجموعة عقارات"
                    className="w-full h-full md:w-[50%] md:h-auto lg:w-64 lg:h-64 absolute top-0 left-0 lg:top-[12.5%] lg:left-[25%] opacity-30 lg:opacity-100"
                    draggable={false}
                />

                <div className="absolute left-0 top-0 w-40 h-40 -rotate-45 overflow-hidden">
                    <svg
                        width="100%"
                        height="100%"
                        viewBox="0 0 160 160"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M160 80C160 124.183 124.183 160 80 160C35.8172 160 0 124.183 0 80"
                            fill="white"
                            fillOpacity="0.2"
                        />
                    </svg>
                </div>
            </section>
        </Container>
    );
};

export default CTASection;
