import { useEffect } from "react";
import { OurValues, PageTopSection, ReportsSection } from "../../components";
import { BackendFile } from "../../types";
import AboutBoxOne from "./AboutBoxOne";
import AboutBoxTwo from "./AboutBoxTwo";

import "./AboutUs.css";

type AboutUsProps = {
    reports: Array<BackendFile>;
    evaluations: Array<BackendFile>;
};

export default function AboutUs({ reports, evaluations }: AboutUsProps) {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);
    return (
        <>
            <PageTopSection title={"من نحن"} description={"خبرة موثوقة"} />
            <>
                <AboutBoxOne />
                <AboutBoxTwo />

                <OurValues />
                <ReportsSection reports={reports} evaluations={evaluations} />
            </>
        </>
    );
}
