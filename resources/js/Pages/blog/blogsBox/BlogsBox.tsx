import Container from "@/components/Container";
import { Post } from "@/types";
import BlogPagination from "./BlogPagination";
import BlogsBoxTitle from "./BlogsBoxTitle";
import BlogsFrame from "./BlogsFrame";

export default function BlogsBox({
    posts,
    max_pages,
}: {
    posts: Array<Post>;
    max_pages: number;
}) {
    return (
        <section className="lg:mt-0 md:my-[80px] mb:[80px]">
            <Container>
                <BlogsBoxTitle />
                <BlogsFrame posts={posts} />
                <BlogPagination max_pages={max_pages} />
            </Container>
        </section>
    );
}
