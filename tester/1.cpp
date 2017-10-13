#include <fstream>
#include <iostream>
#include <string>
int main(int argc, char* argv[])
{
    std::ifstream p1(argv[1]);
    std::ifstream p2(argv[2]);
    if(!(p1.is_open() && p2.is_open()))
        return 1;
    else
    {
        std::string a,b;
        bool c,d;
        while(true)
        {
            c=(p1>>a) && 1;
            d=(p2>>b) && 1;
            if(c!=d)
                return 1;
            if(c==0 && d==0)
                return 0;
            if(a!=b)
                return 1;
        }
    }
}