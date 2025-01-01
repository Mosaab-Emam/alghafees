import ReportsTabs from "./ReportsTabs";
import TextBox from "./TextBox";

import "./ReportsSection.css";

export default function ReportsSection({ reports, evaluations }) {
    return (
        <section className="section-box-shadow rounded-[10px] md:mt-32 mt-96 lg:mb-0 mb-16 pb-12">
            <section className="container">
                <TextBox />
                <ReportsTabs reports={reports} evaluations={evaluations} />
            </section>
        </section>
    );
}
