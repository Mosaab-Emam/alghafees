import { Button, ParagraphContent } from "@/components";
import Container from "@/components/Container";
import Heading from "@/components/Heading";
import { staticContext } from "@/utils/contexts";
import { Link, usePage } from "@inertiajs/react";
import { useContext } from "react";
import MoneyIcon from "../assets/money-icon.svg";
import RiyalIcon from "../assets/riyal.svg";

const PricesSection = () => {
    const price_packages = usePage().props.price_packages as Array<{
        id: number;
        title: string;
        description: string;
        price: number;
        icon: string;
        perks: Array<{ title: string }>;
    }>;

    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <section className="relative mb-16">
            <Container>
                <div className="flex flex-col items-center mb-16">
                    <div className="flex gap-4">
                        <img
                            src={MoneyIcon}
                            alt="Money Icon"
                            className="w-16 h-16"
                        />
                        <div className="flex flex-col">
                            <Heading
                                title={static_content["packages_title"]}
                                size={3}
                            />
                            <ParagraphContent className="max-w-[480px]">
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: static_content[
                                            "packages_description"
                                        ],
                                    }}
                                />
                            </ParagraphContent>
                        </div>
                    </div>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-4 gap-x-6 gap-y-16">
                    {price_packages.map((price_package) => (
                        <div
                            key={price_package.id}
                            className={`flex flex-col border-[3px] border-primary-600 pt-10 px-4 pb-6 relative rounded-br-lg rounded-tl-lg bg-primary-50`}
                        >
                            <div className="flex items-center justify-center bg-white p-2 rounded-full absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 overflow-hidden w-24 h-24">
                                <img
                                    src={price_package.icon}
                                    alt={price_package.title}
                                    className="w-20 h-20 absolute bg-white -translate-y-1 rounded-full"
                                />
                                <div className="w-full h-full rounded-full bg-primary-600" />
                            </div>

                            <div className="flex flex-col items-center text-center">
                                <h4 className={`head-line-h4 mt-4 mb-2`}>
                                    {price_package.title}
                                </h4>

                                <p className="text-sm mb-4 text-gray-600">
                                    {price_package.description}
                                </p>

                                <div className="flex items-center gap-2">
                                    <img src={RiyalIcon} alt="Riyal Icon" />
                                    <h3 className="head-line-h3 text-primary-600">
                                        {price_package.price}
                                    </h3>
                                </div>

                                <div className="w-full flex flex-col gap-4">
                                    <ul className="text-base divide-y divide-gray-200">
                                        {price_package.perks.map(
                                            (perk, perkIndex) => (
                                                <li
                                                    key={perkIndex}
                                                    className="flex items-center gap-3 w-full py-3 font-medium"
                                                >
                                                    <span className="text-lg text-primary-600">
                                                        ✓
                                                    </span>
                                                    <span className="text-base">
                                                        {perk.title}
                                                    </span>
                                                </li>
                                            )
                                        )}
                                    </ul>
                                    <Link
                                        href={route("new-request-evaluation", {
                                            price_package_id: price_package.id,
                                        })}
                                    >
                                        <Button className="w-full">
                                            اطلب التقييم
                                        </Button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </Container>
            <img
                src={MoneyIcon}
                alt="Money Icon"
                className="absolute top-0 hidden md:block left-16 w-24 h-24 lg:w-32 lg:h-32 opacity-30"
            />
        </section>
    );
};

export default PricesSection;
